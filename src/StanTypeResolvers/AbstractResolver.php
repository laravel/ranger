<?php

namespace Laravel\Ranger\StanTypeResolvers;

use Laravel\Ranger\Util\StanTypeResolver;

abstract class AbstractResolver
{
    public function __construct(
        public StanTypeResolver $typeResolver,
    ) {
        //
    }

    protected function from($node)
    {
        return $this->typeResolver->from($node);
    }
}
