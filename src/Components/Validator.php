<?php

namespace Laravel\Ranger\Components;

use Laravel\Ranger\Validation\Rule;

class Validator
{
    /**
     * @param  array<string, list<Rule>>  $rules
     */
    public function __construct(
        public readonly array $rules,
    ) {
        //
    }
}
