<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHasSklads extends Model
{
    protected $table = 'task_has_sklads';

    protected $fillable = [
        'task_id',
        'sklad_id',
        'in_stock',
        'to_purchase',
    ];
}
