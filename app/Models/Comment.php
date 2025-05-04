<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //


    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
