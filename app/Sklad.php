<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sklad extends Model
{
    protected $fillable = ['name', 'type', 'in', 'out'];

    protected $table = 'sklads';

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_sklads');
    }
}
