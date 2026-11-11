<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property-read int|null $comments_count
 */
class Author extends Model
{
    /**
     * @var list<string>
     */
    protected $withCount = [
        'posts',
        'publishedPosts',
        'posts as drafts_count',
        'comments',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function publishedPosts(): HasMany
    {
        return $this->hasMany(Post::class)->whereNotNull('published_at');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
