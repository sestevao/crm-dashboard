<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Article;
use App\Models\Document;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\ProjectUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -- Create users for demo (if none exist) --
        if (User::count() < 5) {
            for ($i = 1; $i <= 5; $i++) {
                User::create([
                    'name' => 'User ' . $i,
                    'email' => 'user' . $i . '@example.com',
                    'password' => Hash::make('password'),
                ]);
            }
        }

        // Create projects
        $projectStatuses = ['planning', 'in_progress', 'completed', 'on_hold'];

        for ($i = 0; $i < 3; $i++) {
            $project = Project::create([
                'name' => 'Project ' . ($i + 1),
                'description' => 'Description for project ' . ($i + 1),
                'image' => 'images/project' . ($i + 1) . '.jpg',
                'start_date' => now()->subDays(rand(10, 20)),
                'deadline' => now()->addMonths(rand(1, 4)),
                'status' => $projectStatuses[array_rand($projectStatuses)],
                'manager_id' => User::inRandomOrder()->first()->id,
                'budget' => rand(10000, 50000),
                'progress' => rand(10, 90),
                'team_members' => User::inRandomOrder()->limit(3)->pluck('id'),
            ]);

            // Realistic tasks for each project
            $tasks = [
                ['title' => 'Design Homepage', 'priority' => 'high', 'estimate' => 16],
                ['title' => 'Develop Login Module', 'priority' => 'high', 'estimate' => 24],
                ['title' => 'Set Up Database', 'priority' => 'medium', 'estimate' => 12],
                ['title' => 'Create API Endpoints', 'priority' => 'low', 'estimate' => 30],
            ];

            $taskStatuses = ['todo', 'in_progress', 'review', 'completed'];

            foreach ($tasks as $index => $taskData) {
                $dueDate = Carbon::parse($project->start_date)->addDays(rand(5, 30));

                ProjectTask::create([
                    'project_id' => $project->id,
                    'title' => $taskData['title'],
                    'description' => 'Detailed task description for ' . $taskData['title'] . '.',
                    'due_date' => $dueDate,
                    'priority' => $taskData['priority'],
                    'status' => $taskStatuses[array_rand($taskStatuses)],
                    'assigned_to' => User::inRandomOrder()->first()->id,
                    'created_at' => $project->start_date,
                    'updated_at' => now(),
                    'estimate' => $taskData['estimate'],
                    'spent_time' => rand(0, $taskData['estimate']),
                    'is_backlog' => 0,
                ]);
            }
        }

        // Create project users with roles and progress
        $roles = ['manager', 'assignee', 'reviewer'];
        for ($i = 0; $i < 10; $i++) {
            ProjectUser::create([
                'project_id' => Project::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'role' => $roles[array_rand($roles)],
                'status' => 'active',
                'progress' => rand(0, 100),
            ]);
        }

        // Create vacancies
        $employmentTypes = ['full-time', 'part-time', 'contract'];
        $vacancyStatuses = ['open', 'closed', 'on_hold'];

        for ($i = 0; $i < 3; $i++) {
            Vacancy::create([
                'title' => 'Position ' . ($i + 1),
                'description' => 'We are looking for a talented professional...',
                'department' => ['Development', 'Marketing', 'Sales'][rand(0, 2)],
                'location' => ['New York', 'London', 'Tokyo'][rand(0, 2)],
                'employment_type' => $employmentTypes[array_rand($employmentTypes)],
                'salary_from' => rand(40000, 60000),
                'salary_to' => rand(70000, 90000),
                'requirements' => ['Bachelor\'s degree', 'Min 3 years experience', 'Team player'],
                'responsibilities' => ['Development', 'Code review', 'Team meetings'],
                'status' => $vacancyStatuses[array_rand($vacancyStatuses)],
                'posting_date' => now(),
                'closing_date' => now()->addMonths(1),
                'hiring_manager_id' => User::inRandomOrder()->first()->id,
            ]);
        }

        // Create categories for info portal
        $categories = ['Company Policies', 'Technical Documentation', 'HR Guidelines'];
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => 'Information about ' . $categoryName,
            ]);
        }

        // Create articles
        $articleStatuses = ['draft', 'published', 'archived'];
        foreach (Category::all() as $category) {
            for ($i = 0; $i < 2; $i++) {
                Article::create([
                    'title' => $category->name . ' Article ' . ($i + 1),
                    'slug' => Str::slug($category->name . ' article ' . ($i + 1)),
                    'content' => 'Detailed content for ' . $category->name . ' article ' . ($i + 1),
                    'category_id' => $category->id,
                    'author_id' => User::inRandomOrder()->first()->id,
                    'status' => $articleStatuses[array_rand($articleStatuses)],
                    'tags' => ['important', 'featured', 'new'],
                ]);
            }
        }

        // Create documents
        foreach (Category::all() as $category) {
            Document::create([
                'title' => $category->name . ' Document',
                'description' => 'Important document for ' . $category->name,
                'file_path' => 'documents/' . Str::slug($category->name) . '.pdf',
                'file_type' => 'pdf',
                'file_size' => rand(1000, 5000),
                'uploaded_by' => User::inRandomOrder()->first()->id,
                'category_id' => $category->id,
                'access_roles' => ['admin', 'manager'],
            ]);
        }

        // Create conversations and messages
        $conversation = Conversation::create([
            'type' => 'group',
            'name' => 'Team Chat',
        ]);

        $users = User::inRandomOrder()->limit(3)->get();
        foreach ($users as $user) {
            $conversation->participants()->attach($user->id, [
                'last_read_at' => now(),
            ]);
        }

        foreach ($users as $user) {
            Message::create([
                'conversation_id' => $conversation->id,
                'user_id' => $user->id,
                'content' => 'Hello team! This is a test message.',
                'type' => 'text',
            ]);
        }
    }
}
