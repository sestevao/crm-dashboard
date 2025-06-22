<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectTask; // or your Task model namespace
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Example tasks for project_id = 1
        ProjectTask::create([
            'project_id' => 1,
            'title' => 'Active Task 1',
            'description' => 'Description for active task 1',
            'due_date' => now()->addDays(5),
            'priority' => 'high',
            'status' => 'in_progress',
            'assigned_to' => 1,
            'is_backlog' => false,
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'title' => 'Backlog Task 1',
            'description' => 'Description for backlog task 1',
            'due_date' => now()->addDays(15),
            'priority' => 'medium',
            'status' => 'todo',
            'assigned_to' => 2,
            'is_backlog' => true,
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'title' => 'Active Task 2',
            'description' => 'Description for active task 2',
            'due_date' => now()->addDays(2),
            'priority' => 'low',
            'status' => 'in_progress',
            'assigned_to' => 3,
            'is_backlog' => false,
        ]);

        ProjectTask::create([
            'project_id' => 1,
            'title' => 'Backlog Task 2',
            'description' => 'Description for backlog task 2',
            'due_date' => now()->addDays(20),
            'priority' => 'high',
            'status' => 'todo',
            'assigned_to' => 1,
            'is_backlog' => true,
        ]);
    }
}
