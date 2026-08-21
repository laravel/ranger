<?php

namespace App\Enums;

use App\Attributes\ConditionalIgnore;
use App\Support\FeatureFlags;

enum ConditionalEnum: string
{
    case REAL = 'real';

    #[ConditionalIgnore(unless: 'features.fake')]
    case FAKE = 'fake';

    #[ConditionalIgnore(unless: [FeatureFlags::class, 'fakeEnabled'])]
    case CALLABLE_FAKE = 'callable-fake';

    #[ConditionalIgnore(when: 'features.hide_retired')]
    case RETIRED = 'retired';
}
