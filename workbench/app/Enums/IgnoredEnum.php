<?php

namespace App\Enums;

use App\Attributes\Ignore;

#[Ignore]
enum IgnoredEnum: string
{
    case ONE = 'one';
    case TWO = 'two';
}
