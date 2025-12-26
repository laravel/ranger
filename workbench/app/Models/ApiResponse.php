<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiResponse extends Model
{
    public static $snakeAttributes = false;

    protected $fillable = [
        'responseData',
        'statusCode',
    ];

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
