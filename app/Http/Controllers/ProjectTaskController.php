<?php

namespace App\Http\Controllers;

use App\Models\ProjectTask;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function show()
    {
        return view('projects.tasks.show');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'assigned_to' => 'required|exists:users,id',
            'estimate' => 'nullable|string',
            'spent_time' => 'nullable|string',
            'is_backlog' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $task = ProjectTask::create($validated);

        return redirect()->route('projects.show', $task)
            ->with('success', 'Task created successfully.');
    }

    public function update(Request $request, ProjectTask $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:todo,in_progress,done',
            'assigned_to' => 'required|exists:users,id',
            'estimate' => 'nullable|string',
            'spent_time' => 'nullable|string',
            'is_backlog' => 'nullable|boolean',
        ]);

        $task->update($validated);

        return redirect()->route('projects.show', $task)
            ->with('success', 'Task updated successfully.');
    }
}
