<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $data = $this->projectService->getAllProjectsWithStats();
        return view('projects.index', $data);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {
        $project = $this->projectService->createProject(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $assignments = ProjectUser::where('project_id', $project->id)->get();
        $taskData = $this->projectService->getProjectTasksByCategory($project);
        
        return view('projects.show', array_merge(
            compact('project', 'assignments'),
            $taskData
        ));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectService->updateProject(
            $project,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project);

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
