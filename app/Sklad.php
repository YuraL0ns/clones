<?php

namespace App;

use App\Models\TaskHasSklads;
use Illuminate\Database\Eloquent\Model;

class Sklad extends Model
{
    protected $fillable = ['name', 'type', 'in', 'out'];

    protected $table = 'sklads';

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_sklads');
    }

    public function inStock($task_id)
    {
        if($taskHasSklad = TaskHasSklads::where('sklad_id', $this->id)->where('task_id', $task_id)->first()){
            return $taskHasSklad->in_stock;
        }

        return false;
    }

    public function toPurchase($task_id)
    {
        if($taskHasSklad = TaskHasSklads::where('sklad_id', $this->id)->where('task_id', $task_id)->first()){
            return $taskHasSklad->to_purchase;
        }

        return false;
    }
}
