<?php

namespace Laravel\Ranger\Collectors;

use Laravel\Ranger\Components\Validator;
use Laravel\Ranger\Support\AnalyzesRoutes;
use Laravel\Ranger\Validation\Rule;
use Laravel\Surveyor\Analyzer\Analyzer;

class FormRequests
{
    use AnalyzesRoutes;

    public function __construct(protected Analyzer $analyzer)
    {
        //
    }

    public function getValidator(array $action): ?Validator
    {
        $result = $this->analyzeRoute($action);

        if (! $result || count($result->validationRules()) === 0) {
            return null;
        }

        return new Validator(
            array_map(
                fn ($rules) => array_map(fn ($rule) => new Rule($rule), $rules),
                $result->validationRules(),
            ),
        );
    }
}
