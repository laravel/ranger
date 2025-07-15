<?php

namespace Laravel\Ranger\DocBlockResolvers\Comment;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use PHPStan\PhpDocParser\Ast;

class Comment extends AbstractResolver
{
    public function resolve(Ast\Comment $node): ResultContract
    {
        dd('Comment not implemented yet');
    }
}
