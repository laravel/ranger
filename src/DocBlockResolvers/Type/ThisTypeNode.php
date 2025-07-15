<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\PhpDocParser\Ast;

class ThisTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\ThisTypeNode $node): ResultContract
    {
        // TODO: Should probably be a class name
        // dd($node, 'ThisTypeNode not implemented yet', debug_backtrace(limit: 3));
        return RangerType::string('$this');
    }
}
