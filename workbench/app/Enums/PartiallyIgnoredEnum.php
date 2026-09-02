<?php

namespace App\Enums;

use App\Attributes\Ignore;
use App\Support\MetaCalls;

enum PartiallyIgnoredEnum: string
{
    case PUBLIC_CASE = 'public';

    #[Ignore]
    case INTERNAL_CASE = 'internal';

    case OTHER_CASE = 'other';

    public function label(): string
    {
        MetaCalls::record($this->name);

        return ucfirst($this->value);
    }
}
