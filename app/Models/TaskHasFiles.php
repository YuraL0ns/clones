<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHasFiles extends Model
{
    protected $table = 'task_has_files';

    protected $fillable = [
        'task_id',
        'name',
    ];
}
