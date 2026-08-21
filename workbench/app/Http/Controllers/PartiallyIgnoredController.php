<?php

namespace App\Http\Controllers;

use App\Attributes\Ignore;

class PartiallyIgnoredController
{
    public function keep(): array
    {
        return ['keep' => 'value'];
    }

    #[Ignore]
    public function hidden(): array
    {
        return ['secret' => 'value'];
    }
}
