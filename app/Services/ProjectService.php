<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    protected ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get all projects with task statistics
     */
    public function getAllProjectsWithStats()
    {
        $projects = $this->projectRepository->getAllProjects();
        
        $allTasks = $projects->pluck('tasks')->flatten();
        $backlogTasks = $allTasks->where('is_backlog', true);
        $activeTasks = $allTasks->where('is_backlog', false);

        return [
            'projects' => $projects,
            'backlogTasks' => $backlogTasks,
            'activeTasks' => $activeTasks,
            'allTasks' => $allTasks,
        ];
    }

    /**
     * Create a new project with image handling
     */
    public function createProject(array $data, $imageFile = null)
    {
        if ($imageFile) {
            $data['image'] = $imageFile->store('projects', 'public');
        }

        return $this->projectRepository->createProject($data);
    }

    /**
     * Update project with image handling
     */
    public function updateProject(Project $project, array $data, $imageFile = null)
    {
        if ($imageFile) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $imageFile->store('projects', 'public');
        }

        return $this->projectRepository->updateProject($project, $data);
    }

    /**
     * Delete project with image cleanup
     */
    public function deleteProject(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $this->projectRepository->deleteProject($project);
    }

    /**
     * Get project tasks categorized by backlog status
     */
    public function getProjectTasksByCategory(Project $project)
    {
        $allTasks = $project->tasks;
        
        return [
            'backlogTasks' => $allTasks->where('is_backlog', 1),
            'activeTasks' => $allTasks->where('is_backlog', 0),
            'allTasks' => $allTasks,
        ];
    }
}
