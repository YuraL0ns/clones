<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Project $project)
    {
        Comment::create([
        	'body' => request('body'),
        	'project_id' => $project->id
        ]);
        return back();
    }
}
