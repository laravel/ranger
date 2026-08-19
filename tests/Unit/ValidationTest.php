<?php

use Illuminate\Validation\Rules\Enum;
use Laravel\Ranger\Validation\Rule;

describe('Rule class', function () {
    it('can be instantiated with a rule array', function () {
        $rule = new Rule(['required', []]);

        expect($rule->rule())->toBe('required');
    });

    it('returns the rule identifier', function () {
        $rule = new Rule(['string', []]);

        expect($rule->rule())->toBe('string');
    });

    it('returns rule parameters', function () {
        $rule = new Rule(['max', ['value' => 255]]);

        expect($rule->getParams())->toBe(['value' => 255]);
    });

    it('checks if rule matches an identifier', function () {
        $rule = new Rule(['required', []]);

        expect($rule->is('required'))->toBeTrue();
        expect($rule->is('string'))->toBeFalse();
    });

    it('detects enum rules', function () {
        $enumRule = new Enum('App\\Enums\\Status');
        $rule = new Rule([$enumRule, []]);

        expect($rule->isEnum())->toBeTrue();
    });

    it('returns false for non-enum rules', function () {
        $rule = new Rule(['required', []]);

        expect($rule->isEnum())->toBeFalse();
    });

    it('detects when rule has parameters', function () {
        $ruleWithParams = new Rule(['max', ['value' => 255, 'other' => true]]);
        $ruleWithOneParam = new Rule(['array', ['only' => 'one']]);
        $ruleWithoutParams = new Rule(['required', []]);

        expect($ruleWithParams->hasParams())->toBeTrue();
        expect($ruleWithOneParam->hasParams())->toBeTrue();
        expect($ruleWithoutParams->hasParams())->toBeFalse();
    });
});
