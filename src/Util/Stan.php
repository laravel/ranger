<?php

namespace Laravel\Ranger\Util;

use Laravel\Ranger\Debug;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\NodeAbstract;
use PHPStan\Analyser\ScopeContext;
use PHPStan\Analyser\ScopeFactory;
use PHPStan\Type\MixedType;
use PHPStan\Type\VerbosityLevel;

class Stan
{
    public function __construct(protected ScopeFactory $scopeFactory)
    {
        //
    }

    public function getType(NodeAbstract $node): ?ResultContract
    {
        $this->scope = $this->scopeFactory->create(ScopeContext::create(''));

        try {
            $type = $this->scope->getType($node);

            $stanType = match (true) {
                method_exists($type, 'getType') => $type->getType(),
                default => $type,
                // default => $type->describe(VerbosityLevel::typeOnly()),
            };
        } catch (\Throwable $e) {
            Debug::log('Stan::getType error: '.$e->getMessage().' (Memory: '.number_format(memory_get_usage(true) / 1024 / 1024, 2).'MB)');

            return null;
        }

        $stanType = $stanType ?? 'mixed';

        if ($stanType !== 'mixed' && ! ($stanType instanceof MixedType)) {
            if (is_array($stanType)) {
                return RangerType::union(...array_map(fn ($type) => app(StanTypeResolver::class)->from($type), $stanType));
            }

            return app(StanTypeResolver::class)->from($stanType);
        }

        return null;
    }

    public function getClassMethodReturnType(NodeAbstract $node): ?Result
    {
        $this->scope = $this->scopeFactory->create(ScopeContext::create(''));

        $type = $this->scope->getType($node);
        $stanType = $type?->getTypes() ?? $type->describe(VerbosityLevel::typeOnly());

        dd($type, $stanType);

        // try {
        // dd($this->scope->enterClassMethod($node));
        // TODO: Are we using this? Should be returning types, not describe...
        $stanType = $this->scope->enterClassMethod($node)->describe(VerbosityLevel::typeOnly());
        // } catch (\Throwable $e) {
        //     Debug::log('Stan::getType error: ' . $e->getMessage() . ' (Memory: ' . number_format(memory_get_usage(true) / 1024 / 1024, 2) . 'MB)');

        //     return null;
        // }

        if ($stanType === 'Illuminate\\Http\\Request') {
            dd('got it');
        }

        if (($stanType ?? 'mixed') !== 'mixed') {
            if (is_array($stanType)) {
                return RangerType::union(...array_map(fn ($type) => app(StanTypeResolver::class)->from($type), $stanType));
            }

            return app(StanTypeResolver::class)->from($stanType);
        }

        return null;
    }

    public function getFunctionReturnType(NodeAbstract $node): ?Result
    {
        $this->scope = $this->scopeFactory->create(ScopeContext::create(''));

        // try {
        // dd($this->scope->enterClassMethod($node));
        $stanType = $this->scope->enterArrowFunction($node, null);
        dd($stanType->getAnonymousFunctionReturnType());
        // ->describe(VerbosityLevel::typeOnly());
        // $stanType = $this->scope->enterAnonymousFunction($node)->describe(VerbosityLevel::typeOnly());
        // } catch (\Throwable $e) {
        //     Debug::log('Stan::getType error: ' . $e->getMessage() . ' (Memory: ' . number_format(memory_get_usage(true) / 1024 / 1024, 2) . 'MB)');

        //     return null;
        // }

        if ($stanType === 'Illuminate\\Http\\Request') {
            dd('got it');
        }

        if (($stanType ?? 'mixed') !== 'mixed') {
            if (is_array($stanType)) {
                return RangerType::union(...array_map(fn ($type) => app(StanTypeResolver::class)->from($type), $stanType));
            }

            return app(StanTypeResolver::class)->from($stanType);
        }

        return null;
    }
}
