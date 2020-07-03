<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'quest',
        'start',
        'end',
        'ps',
        'pe',
        'ss',
        'se',
        'prs',
        'pre',
        'files_path',
        'safe_detail',
        'safe_material',
        'safe_purchased'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function status()
    {
     	return $this->hasMany(Status::class);
    }
     public function status_list()
    {
     	return $this->hasMany(Status_list::class);
    }

    public function owners()
    {
        return $this->belongsToMany(User::class, 'users_projects');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'project_id', 'id');
    }

    public function safes()
    {
        return $this->belongsToMany(Sklad::class, 'projects_sklads');
    }
}
