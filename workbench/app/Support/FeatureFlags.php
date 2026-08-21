<?php

namespace App\Support;

class FeatureFlags
{
    public static function fakeEnabled(): bool
    {
        return (bool) config('features.fake_callable');
    }
}
