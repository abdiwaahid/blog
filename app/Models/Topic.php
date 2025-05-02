<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function parent()
    {
        return $this->belongsTo(Topic::class, 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(Topic::class, 'parent_id');
    }

    
}
