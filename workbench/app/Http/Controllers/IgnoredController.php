<?php

namespace App\Http\Controllers;

use App\Attributes\Ignore;

#[Ignore]
class IgnoredController
{
    public function index(): array
    {
        return ['secret' => 'value'];
    }
}
