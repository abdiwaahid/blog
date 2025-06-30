<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskHistory extends Model
{
    public $table = 'task_history';

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

}
