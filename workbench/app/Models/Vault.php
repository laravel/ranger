<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vault extends Model
{
    public function secrets(): HasMany
    {
        return $this->hasMany(SecretModel::class);
    }
}
