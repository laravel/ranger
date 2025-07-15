<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeVisitor\ParentConnectingVisitor;
use PhpParser\Parser as PhpParserParser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use SplFileInfo;
use Throwable;

class Parser
{
    protected NodeFinder $nodeFinder;

    protected PhpParserParser $parser;

    protected NodeTraverser $nodeTraverser;

    public function __construct(
        protected Standard $prettyPrinter,
    ) {
        $this->parser = (new ParserFactory)->createForHostVersion();
        $this->nodeFinder = new NodeFinder;
        $this->nodeTraverser = new NodeTraverser(new ParentConnectingVisitor);
        $this->nodeTraverser->addVisitor(new NameResolver);
    }

    public function parse(string|ReflectionClass|ReflectionFunction|ReflectionMethod|SplFileInfo $code): array
    {
        try {
            $code = match (true) {
                is_string($code) => $code,
                $code instanceof SplFileInfo => file_get_contents($code->getPathname()),
                default => file_get_contents($code->getFileName()),
            };

            return $this->nodeTraverser->traverse($this->parser->parse($code));
        } catch (Throwable $e) {
            Debug::log("Error parsing code: {$e->getMessage()}", [
                'code' => $code,
            ]);

            return [];
        }
    }

    public function nodeFinder()
    {
        return $this->nodeFinder;
    }

    public function printer()
    {
        return $this->prettyPrinter;
    }
}
