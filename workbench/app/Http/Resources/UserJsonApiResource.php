<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class UserJsonApiResource extends JsonApiResource
{
    public static $type = 'users';

    public static $attributes = ['name', 'email'];
}
