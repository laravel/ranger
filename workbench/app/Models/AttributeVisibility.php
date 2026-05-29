<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Visible;
use Illuminate\Database\Eloquent\Model;

#[Visible(['id', 'email'])]
#[Hidden(['password'])]
#[Appends(['full_name'])]
class AttributeVisibility extends Model
{
    /**
     * @var list<string>
     */
    protected $visible = [
        'name',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * @var list<string>
     */
    protected $appends = [
        'avatar_url',
    ];
}
