<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Comment extends Model

{
	protected $table = 'comments';
	protected $fillable = array('body', 'project_id');

	public function project()
	   {
	       return $this->belongsTo(Project::class);
	   }
}

