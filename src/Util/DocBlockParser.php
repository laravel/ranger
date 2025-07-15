<?php

namespace Laravel\Ranger\Util;

use Illuminate\Support\Collection;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node\Expr\CallLike;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;

class DocBlockParser
{
    protected ?CallLike $node = null;

    protected PhpDocNode $parsed;

    protected Lexer $lexer;

    protected PhpDocParser $phpDocParser;

    public function __construct(
        protected DocBlockTypeResolver $typeResolver,
    ) {
        $config = new ParserConfig(usedAttributes: []);
        $constExprParser = new ConstExprParser($config);
        $typeParser = new TypeParser($config, $constExprParser);

        $this->lexer = new Lexer($config);
        $this->phpDocParser = new PhpDocParser($config, $typeParser, $constExprParser);
    }

    public function parseReturn(string $docBlock, ?CallLike $node = null): ?Collection
    {
        $this->node = $node;

        $this->parse($docBlock);

        $returnTypeValues = $this->parsed->getReturnTagValues();

        if (count($returnTypeValues) === 0) {
            return null;
        }

        // TODO: Format this output
        return collect($returnTypeValues)->map($this->resolve(...));
    }

    public function parseVar(string $docBlock): ?ResultContract
    {
        $this->parse($docBlock);

        $varTagValues = $this->parsed->getVarTagValues();

        if (count($varTagValues) === 0) {
            return null;
        }

        $result = collect($varTagValues)
            ->map(fn ($tag) => $this->resolve($tag->type))
            ->unique();

        if ($result->count() === 1) {
            return $result->first();
        }

        return RangerType::union(...$result);
    }

    protected function parse(string $docBlock): PhpDocNode
    {
        $tokens = new TokenIterator($this->lexer->tokenize($docBlock));
        $this->parsed = $this->phpDocParser->parse($tokens);

        return $this->parsed;
    }

    protected function resolve($value): ResultContract|string
    {
        return $this->typeResolver->setParsed($this->parsed)->setReferenceNode($this->node)->from($value);
    }
}
