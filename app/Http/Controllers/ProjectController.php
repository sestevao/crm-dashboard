<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['tasks', 'manager'])
            ->orderBy('start_date', 'desc')
            ->get();

        $allTasks = $projects->pluck('tasks')->flatten();

        $backlogTasks = $allTasks->where('is_backlog', true);
        $activeTasks = $allTasks->where('is_backlog', false);

        return view('projects.index', compact('projects', 'backlogTasks', 'activeTasks', 'allTasks'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after:start_date',
            'status' => 'required|string',
            'manager_id' => 'required|exists:users,id',
            'budget' => 'nullable|numeric',
            'progress' => 'required|integer|min:0|max:100',
            'team_members' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $project = Project::create($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $assignments = ProjectUser::where('project_id', $project->id)->get();
        $allTasks = $project->tasks;

        // Filter tasks based on is_backlog fiel
        $backlogTasks = $allTasks->where('is_backlog', 1);
        $activeTasks = $allTasks->where('is_backlog', 0);

        return view('projects.show', compact('project', 'assignments', 'backlogTasks', 'activeTasks', 'allTasks'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after:start_date',
            'status' => 'required|string',
            'manager_id' => 'required|exists:users,id',
            'budget' => 'nullable|numeric',
            'progress' => 'required|integer|min:0|max:100',
            'team_members' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $project->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
