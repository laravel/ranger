<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserJsonApiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Support\CheckoutSummary;

class ResourceController
{
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function jsonApi(User $user): UserJsonApiResource
    {
        return new UserJsonApiResource($user);
    }

    public function summary(): CheckoutSummary
    {
        return new CheckoutSummary(100, 'USD');
    }

    public function plain(): \stdClass
    {
        return new \stdClass;
    }
}
