<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col items-start space-y-4 w-full">
                <div class="flex items-center justify-between w-full">
                    <div>
                        <p class="font-medium text-gray-800 dark:text-gray-200 leading-tight pb-4">
                            Welcome back, {{ Auth::user()->name }}!
                        </p>
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                    </div>
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-lg px-4 py-2 flex items-center gap-2">
                        <i class="fa-solid fa-calendar"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            {{ now()->subDays(7)->format('j M Y') }} - {{ now()->format('j M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Top Bar with Search and Notification -->
    <div class="max-w-7xl mx-auto mb-4 flex items-center justify-between">
        <!-- Search Box -->
        <div class="w-1/3 relative">
            <input type="text" id="search" placeholder="Search..."
                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 pl-10 pr-4 focus:border-blue-500 focus:ring-blue-500" />
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>

        <!-- Notification Bell -->
        <button aria-label="Notifications"
            class="p-3 bg-white dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 focus:outline-none relative">
            <i class="fa-solid fa-bell fa-xl"></i>
            <span
                class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold text-red-100 bg-red-600 rounded-full">3</span>
        </button>
    </div>

    <!-- Main Content Area -->
    <div class="my-10 space-y-8  h-[calc(100vh-20rem)]">
        <div class="max-w-7xl mx-auto flex gap-4">
            <!-- Workload Section -->
            <div class="w-2/3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Workload</h2>
                    <a href="{{ route('employees') }}" class="text-blue-400 hover:underline flex items-center gap-2">
                        View all <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($worflow_users as $user)
                    <div class="bg-[#F4F9FD] dark:bg-gray-700 flex flex-col items-center rounded-2xl shadow-sm gap-2 p-4">
                        <div class="relative w-[52px] h-[52px]">
                            <!-- Progress Circle -->
                            <svg class="absolute top-0 left-0 w-full h-full -rotate-90">
                                <circle cx="26" cy="26" r="24" stroke-width="4" stroke="#E5E7EB" fill="none"></circle>
                                <circle cx="26" cy="26" r="24" stroke-width="4" stroke="#3B82F6" fill="none"
                                    stroke-dasharray="150.8" stroke-dashoffset="{{ 150.8 * (1 - 0.25) }}"></circle>
                            </svg>
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full z-10" />
                        </div>
                        <h3 class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->position }}</p>
                        <div class="border border-gray-300 dark:border-gray-600 p-1 rounded-lg bg-gray-100 dark:bg-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->department }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Events Section -->
            <div class="w-1/3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Nearest Events</h2>
                    <a href="{{ route('events.index') }}" class="text-blue-400 hover:underline flex items-center gap-2">
                        View all <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <div class="flex flex-col gap-6">
                    @forelse($upcoming_events as $event)
                    @php
                    $colors = [
                    'birthday' => ['border' => 'border-pink-500', 'bg' => 'bg-pink-50 dark:bg-pink-900'],
                    'meeting' => ['border' => 'border-blue-500', 'bg' => 'bg-blue-50 dark:bg-blue-900'],
                    'holiday' => ['border' => 'border-green-500', 'bg' => 'bg-green-50 dark:bg-green-900']
                    ];
                    $borderColor = $colors[$event->type]['border'] ?? 'border-gray-500';
                    $bgColor = $colors[$event->type]['bg'] ?? 'bg-gray-50 dark:bg-gray-700';
                    @endphp
                    <div class="flex flex-col {{ $borderColor }} border-l-4 {{ $bgColor }} p-4 space-y-4 rounded-md">
                        <div class="flex justify-between items-start">
                            <a href="{{ route('events.show', $event->id) }}" class="font-medium text-gray-900 dark:text-gray-100 w-1/2 truncate">{{ $event->title }}</a>
                            <div class="w-1/2 flex justify-end">
                                <i class="fa-solid {{ \Carbon\Carbon::parse($event->start_date)->isFuture() ? 'fa-arrow-up text-yellow-400' : 'fa-arrow-down text-green-500' }}"></i>
                            </div>
                        </div>
                        <div class="flex justify-between items-start">
                            <p class="text-sm text-gray-500 dark:text-gray-400 w-1/2">{{ \Carbon\Carbon::parse($event->start_date)->format('l | g:i A') }}</p>
                            <div class="w-1/2 flex justify-end">
                                <div class="bg-yellow-400 p-1 rounded-lg flex items-center gap-2">
                                    <i class="fa-solid fa-clock"></i>
                                    <p class="text-xs text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($event->start_date)->diffForHumans(null, true) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 dark:text-gray-400">No upcoming events.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Projects and Activity Stream -->
        <div class="max-w-7xl mx-auto flex gap-4">
            <!-- Projects Section -->
            <div class="w-2/3 p-4 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Projects</h2>
                    <a href="{{ route('projects.index') }}" class="text-blue-400 hover:underline flex items-center gap-2">
                        View all <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                @foreach($recent_projects as $project)
                <div class="flex bg-white dark:bg-gray-700 rounded-lg shadow-sm mb-4">
                    <!-- Project Info -->
                    <div class="w-1/2 p-4 border-r border-gray-300 space-y-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('images/project1.png') }}" alt="Project Image" class="w-12 h-12">
                            <div>
                                <h3 class="font-medium text-gray-900 dark:text-gray-100">PN000{{ $project->id }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $project->name }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center text-sm text-gray-400">
                                <i class="fa-solid fa-calendar mr-1"></i> Created {{ $project->formatted_created_at }}
                            </span>
                            @php
                            $priorities = [
                            'low' => ['color' => 'text-green-500', 'icon' => 'fa-arrow-down'],
                            'medium' => ['color' => 'text-yellow-400', 'icon' => 'fa-arrow-up'],
                            'high' => ['color' => 'text-red-500', 'icon' => 'fa-arrow-up'],
                            ];
                            $priority = $priorities[$project->priority] ?? ['color' => 'text-gray-500', 'icon' => 'fa-minus'];
                            @endphp
                            <span class="flex items-center gap-2 {{ $priority['color'] }}">
                                <i class="fa-solid {{ $priority['icon'] }}"></i> {{ ucfirst($project->priority) }}
                            </span>
                        </div>
                    </div>
                    <!-- Project Stats -->
                    <div class="w-1/2 p-4 space-y-4">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200">Project Data</h3>
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="text-gray-400">All tasks</p>
                                <p>{{ $project->tasks->count() }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400">Active tasks</p>
                                <p>{{ $project->active_tasks_count }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400">Assignees</p>
                                <div class="flex -space-x-2">
                                    @for($i = 0; $i < 3; $i++)
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full">
                                        @endfor
                                        <span class="w-6 h-6 bg-blue-600 text-white text-xs flex items-center justify-center rounded-full">+2</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Activity Stream Section -->
            <div class="w-1/3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Activity Stream</h2>
                <div class="space-y-4">
                    @foreach(range(1,2) as $index)
                    <div class="flex items-center space-x-4">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" alt="Member" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <h3 class="text-gray-900 dark:text-gray-100 font-medium">User {{ $index }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Role</p>
                        </div>
                    </div>
                    <div class="bg-[#F4F9FD] dark:bg-gray-700 p-4 rounded-lg text-sm text-gray-500 dark:text-gray-400 flex items-center gap-4">
                        <i class="fa-solid fa-paperclip text-indigo-800 dark:text-indigo-200"></i>
                        <span>Attached files to the task</span>
                    </div>
                    <div class="bg-[#F4F9FD] dark:bg-gray-700 p-4 rounded-lg text-sm text-gray-500 dark:text-gray-400 flex items-center gap-4">
                        <i class="fa-solid fa-cloud-arrow-up text-indigo-800 dark:text-indigo-200"></i>
                        <span>Updated task status to In Progress</span>
                    </div>
                    @endforeach
                </div>
                <a href="#" class="mt-4 block text-blue-400 hover:underline text-center">View more <i class="fas fa-angle-down"></i></a>
            </div>

        </div>
</x-app-layout>