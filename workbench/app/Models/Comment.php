<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'post_id',
        'user_id',
    ];

    protected $with = ['post', 'authored_by'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function authoredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
