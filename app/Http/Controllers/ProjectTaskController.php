<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function show()
    {
        return view('projects.tasks.show');
    }
}