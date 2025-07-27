<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    /**
     * Get all projects with related data
     */
    public function getAllProjects()
    {
        return Project::with(['tasks', 'manager'])
            ->orderBy('start_date', 'desc')
            ->get();
    }

    /**
     * Create a new project with validated data
     */
    public function createProject(array $data)
    {
        return Project::create($data);
    }

    /**
     * Update project data
     */
    public function updateProject(Project $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    /**
     * Delete a project
     */
    public function deleteProject(Project $project)
    {
        $project->delete();
    }
}

