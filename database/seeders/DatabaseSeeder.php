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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create events
        $eventTypes = ['meeting', 'training', 'social', 'workshop'];
        $eventStatuses = ['upcoming', 'ongoing', 'completed'];

        for ($i = 0; $i < 5; $i++) {
            Event::create([
                'title' => 'Company ' . ucfirst($eventTypes[array_rand($eventTypes)]),
                'description' => 'Description for the event ' . ($i + 1),
                'start_date' => now()->addDays(rand(1, 30)),
                'end_date' => now()->addDays(rand(31, 60)),
                'location' => 'Room ' . rand(100, 999),
                'type' => $eventTypes[array_rand($eventTypes)],
                'created_by' => User::inRandomOrder()->first()->id,
                'attendees' => User::inRandomOrder()->limit(3)->pluck('id'),
                'status' => $eventStatuses[array_rand($eventStatuses)],
            ]);
        }

        // Create projects
        $projectStatuses = ['planning', 'in_progress', 'completed', 'on_hold'];

        for ($i = 0; $i < 3; $i++) {
            $project = Project::create([
                'name' => 'Project ' . ($i + 1),
                'description' => 'Description for project ' . ($i + 1),
                'image' => 'images/project' . ($i + 1) . '.jpg',
                'start_date' => now(),
                'deadline' => now()->addMonths(3),
                'status' => $projectStatuses[array_rand($projectStatuses)],
                'manager_id' => User::inRandomOrder()->first()->id,
                'budget' => rand(10000, 50000),
                'progress' => rand(0, 100),
                'team_members' => User::inRandomOrder()->limit(3)->pluck('id'),
            ]);

            // Create tasks for each project
            $taskPriorities = ['low', 'medium', 'high'];
            $taskStatuses = ['todo', 'in_progress', 'review', 'completed'];

            for ($j = 0; $j < 4; $j++) {
                ProjectTask::create([
                    'project_id' => $project->id,
                    'title' => 'Task ' . ($j + 1),
                    'description' => 'Description for task ' . ($j + 1),
                    'due_date' => now()->addDays(rand(1, 30)),
                    'priority' => $taskPriorities[array_rand($taskPriorities)],
                    'status' => $taskStatuses[array_rand($taskStatuses)],
                    'assigned_to' => User::inRandomOrder()->first()->id,
                ]);
            }
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
