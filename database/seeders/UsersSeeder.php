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

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'position' => 'System Administrator',
            'department' => 'IT',
            'phone' => '+1234567890',
            'bio' => 'Experienced system administrator with expertise in CRM systems.',
            'skills' => ['PHP', 'Laravel', 'MySQL', 'System Administration'],
            'hire_date' => now()->subYears(2),
        ]);

        // New random users
        $users = [
            [
                'name' => 'John Developer',
                'email' => 'john@example.com',
                'position' => 'Senior Developer',
                'department' => 'Development',
                'skills' => ['PHP', 'JavaScript', 'Vue.js'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=543',
            ],
            [
                'name' => 'Sarah Manager',
                'email' => 'sarah@example.com',
                'position' => 'Project Manager',
                'department' => 'Management',
                'skills' => ['Project Management', 'Agile', 'Scrum'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=233'
            ],
            [
                'name' => 'Mike HR',
                'email' => 'mike@example.com',
                'position' => 'HR Manager',
                'department' => 'Human Resources',
                'skills' => ['Recruitment', 'Employee Relations'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=832'
            ],
            [
                'name' => 'Anna Designer',
                'email' => 'anna@example.com',
                'position' => 'UI/UX Designer',
                'department' => 'Design',
                'skills' => ['Figma', 'Adobe XD', 'Illustrator'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=101',
            ],
            [
                'name' => 'David Analyst',
                'email' => 'david@example.com',
                'position' => 'Data Analyst',
                'department' => 'Analytics',
                'skills' => ['SQL', 'Excel', 'Power BI'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=654',
            ],
            [
                'name' => 'Linda Tester',
                'email' => 'linda@example.com',
                'position' => 'QA Engineer',
                'department' => 'Quality Assurance',
                'skills' => ['Selenium', 'Cypress', 'Manual Testing'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=999',
            ],
            [
                'name' => 'Tom DevOps',
                'email' => 'tom@example.com',
                'position' => 'DevOps Engineer',
                'department' => 'Infrastructure',
                'skills' => ['AWS', 'Docker', 'Kubernetes'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=444',
            ],
            [
                'name' => 'Emily Content',
                'email' => 'emily@example.com',
                'position' => 'Content Writer',
                'department' => 'Marketing',
                'skills' => ['SEO', 'Copywriting', 'Social Media'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=721',
            ],
            [
                'name' => 'Chris Support',
                'email' => 'chris@example.com',
                'position' => 'Support Specialist',
                'department' => 'Customer Service',
                'skills' => ['Zendesk', 'CRM', 'Communication'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=303',
            ],
            [
                'name' => 'Olivia Accountant',
                'email' => 'olivia@example.com',
                'position' => 'Accountant',
                'department' => 'Finance',
                'skills' => ['QuickBooks', 'Excel', 'Taxation'],
                'avatar_url' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=282',
            ],
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'position' => $userData['position'],
                'department' => $userData['department'],
                'phone' => '+1' . rand(1000000000, 9999999999),
                'bio' => 'Professional with experience in ' . $userData['department'],
                'skills' => $userData['skills'],
                'hire_date' => now()->subMonths(rand(1, 24)),
                'avatar_url' => $userData['avatar_url'],
            ]);
        }
    }
}
