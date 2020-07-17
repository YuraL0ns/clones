<?php

namespace App;

use App\Models\TaskHasFiles;
use App\Models\TaskHasSklads;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'descriptions',
        'start_date',
        'end_date',
        'done',
        'created_at',
        'updated_at'
    ];

    public $with = ['owner'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(TaskHasFiles::class, 'task_id', 'id');
    }

    public function hasSklads()
    {
        return $this->hasMany(TaskHasSklads::class, 'task_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
