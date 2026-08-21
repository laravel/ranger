<?php

namespace App\Enums;

use App\Attributes\Ignore;

enum PartiallyIgnoredEnum: string
{
    case PUBLIC_CASE = 'public';

    #[Ignore]
    case INTERNAL_CASE = 'internal';

    case OTHER_CASE = 'other';
}
