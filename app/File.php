<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'user_id', 'icon', 'type'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
