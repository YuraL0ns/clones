<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
                'descriptions', 
                'start_date', 
                'end_date', 'user_id',
                'project_id',
                'created_at', 
                'updated_at'
          ];

    public $with = ['owner'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
