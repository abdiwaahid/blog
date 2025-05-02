<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    //

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where('published_at', '<=', now());
    }
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isBookmarkedBy($user)
    {
        return $this->bookmarks()->where('user_id', $user)->exists();
    }
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user)->exists();
    }
}
