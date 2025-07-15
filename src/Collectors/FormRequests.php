<?php

namespace Laravel\Ranger\Collectors;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule as ValidationRule;
use Laravel\Ranger\Components\Validator;
use Laravel\Ranger\Debug;
use Laravel\Ranger\Util\Parser;
use Laravel\Ranger\Util\TypeResolver;
use Laravel\Ranger\Validation\Rule;
use Laravel\Ranger\Validation\Rules;
use PhpParser\Node;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Param;
use PhpParser\Node\Scalar\String_;
use ReflectionClass;
use ReflectionMethod;
use Spatie\StructureDiscoverer\Discover;
use SplFileInfo;
use Stringable;
use Symfony\Component\Finder\Finder;

class FormRequests
{
    protected $imports = [];

    public function __construct(
        protected Parser $parser,
        protected TypeResolver $typeResolver,
    ) {
        //
    }

    public function parseRequest(array $action): ?Validator
    {
        if ($action['uses'] instanceof Closure) {
            $reflection = new \ReflectionFunction($action['uses']);
        } else {
            [$controller, $method] = explode('@', $action['uses']);
            $classReflection = new \ReflectionClass($controller);
            $reflection = $classReflection->getMethod($method);
        }

        $contents = file_get_contents($reflection->getFileName());

        $parsed = $this->parser->parse($contents);

        if ($reflection instanceof ReflectionMethod) {
            $node = $this->parser->nodeFinder()->findFirst(
                $parsed,
                fn($node) =>
                $node instanceof Node\Stmt\ClassMethod &&
                    $node->name->toString() === $method,

            );

            if ($node) {
                $formRequest = collect($node->getParams())->filter($this->isFormRequest(...))->first();

                if ($formRequest) {
                    return new Validator(
                        $this->getRuleFields($formRequest->type->toString())->all(),
                        $formRequest->type->toString(),
                    );
                }
            }
        }

        $node = $this->parser->nodeFinder()->findFirst(
            $parsed,
            fn($node) =>
            $node->getStartLine() >= $reflection->getStartLine()
                && $node->getEndLine() <= $reflection->getEndLine()
                && $node instanceof Node\Expr\StaticCall
                && $node->name->toString() === 'validate'
                && $node->class->toString() === Request::class
                && $node->getArgs()[0]->value instanceof Node\Expr\Array_
        );

        if (!$node) {
            return null;
        }

        $fields = collect($node->getArgs()[0]->value->items)
            ->mapWithKeys($this->normalizeRules(...))
            ->undot();

        return new Validator($fields->all());
    }

    protected function isFormRequest(Param $item): bool
    {
        if (!($item->type instanceof Node\Name\FullyQualified) || !class_exists($item->type->toString())) {
            return false;
        }

        $reflection = new \ReflectionClass($item->type->toString());

        return $reflection->isSubclassOf(FormRequest::class);
    }

    protected function getRuleFields(string $class): Collection
    {
        $reflectionClass = new ReflectionClass($class);

        if ($reflectionClass->isAbstract() || ! $reflectionClass->isInstantiable()) {
            return collect([]);
        }

        $stmts = $this->parser->parse($reflectionClass);
        $method = $this->parser->nodeFinder()->find($stmts, fn(Node $node) => $node instanceof Node\Stmt\ClassMethod && $node->name->toString() === 'rules');

        Debug::log("Processing {$class}...");

        return collect($this->parser->nodeFinder()->find($method, fn(Node $node) => $node instanceof Node\Stmt\Return_))
            ->filter(fn(Node\Stmt\Return_ $node) => $node->expr instanceof Node\Expr\Array_)
            ->map(fn(Node\Stmt\Return_ $node) => $node->expr)
            ->map(
                fn(Node\Expr\Array_ $node) => collect($node->items)
                    ->mapWithKeys($this->normalizeRules(...))
                    ->undot()
            )
            ->flatMap(fn($r) => $r);
    }

    protected function normalizeRules(Node\Expr\ArrayItem $item)
    {
        $key = null;

        if ($item->key instanceof Node\Scalar\String_) {
            $key = $item->key->value;
        }

        if ($item->value instanceof Node\Expr\Array_) {
            return [
                $key => collect($item->value->items)
                    ->filter(fn(Node\Expr\ArrayItem $item) => $item->value instanceof String_
                        || ($item->value instanceof StaticCall && $item->value->class->toString() === ValidationRule::class))
                    ->map(function (Node\Expr\ArrayItem $item) {
                        if ($item->value instanceof String_) {
                            return $item;
                        }

                        $expr = $this->parser->printer()->prettyPrintExpr($item->value);

                        try {
                            $result = eval('return call_user_func(function() { return ' . $expr . '; });');

                            return $result instanceof Stringable ? (string) $result : $result;
                        } catch (\Throwable $e) {
                            Debug::log("Error evaluating rule: {$expr}", $e->getMessage());

                            return false;
                        }

                        return false;
                    })
                    ->filter()
                    ->map(
                        fn($item) => $item instanceof ArrayItem && $item->value instanceof String_
                            ? new Rule($item->value->value) : new Rule($item)
                    ),
            ];
        }

        if ($item->value instanceof String_) {
            return [
                $key => collect(explode('|', $item->value->value))
                    ->map('trim')
                    ->map(fn($rule) => new Rule($rule)),
            ];
        }

        return [$key => collect([])];
    }
}
