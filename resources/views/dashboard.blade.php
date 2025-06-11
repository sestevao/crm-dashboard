<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-start space-y-4">
            <div class="flex items-center justify-between w-full">
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200 leading-tight">
                        Welcome back, {{ Auth::user()->name }}!
                    </p>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </div>
                <div class="bg-gray-200 dark:bg-gray-700 rounded-lg px-4 py-2 flex items-center justify-center gap-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 2C16.5523 2 17 2.44772 17 3V4C19.2091 4 21 5.79086 21 8V18C21 20.2091 19.2091 22 17 22H7C4.79086 22 3 20.2091 3 18V8C3 5.79086 4.79086 4 7 4V3C7 2.44772 7.44772 2 8 2C8.55228 2 9 2.44772 9 3V4H15V3C15 2.44772 15.4477 2 16 2ZM5 18C5 19.0543 5.81581 19.9177 6.85059 19.9941L7 20H17C18.0543 20 18.9177 19.1842 18.9941 18.1494L19 18V11H5V18ZM8.99512 6.10254C8.94379 6.60667 8.51768 7 8 7C7.48232 7 7.05621 6.60667 7.00488 6.10254L7 6C5.9457 6 5.08229 6.81581 5.00586 7.85059L5 8V9H19V8C19 6.9457 18.1842 6.08229 17.1494 6.00586L17 6L16.9951 6.10254C16.9438 6.60667 16.5177 7 16 7C15.4823 7 15.0562 6.60667 15.0049 6.10254L15 6H9L8.99512 6.10254Z" fill="#0A1629" />
                    </svg>

                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ now()->subDays(7)->format('j M Y') }} - {{ now()->format('j M Y') }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Top Bar with Search and Notification -->
    <div class="mb-4 flex items-center justify-between">
        <div class="w-1/3">
            <input type="text" id="search" placeholder="Search..." class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>
        <button class="p-3 bg-white dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 focus:outline-none relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform bg-red-600 rounded-full">3</span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Workload Section -->
            <div class="max-w-7xl mx-auto space-y-4">
                <div class="flex gap-4">
                    <div class="w-2/3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Workload</h2>
                            <a href="{{ route('employees') }}" class="text-blue-400 font-bold flex items-center justify-center gap-2 view_more">
                                View all

                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($worflow_users as $user)
                            <div class="bg-[#F4F9FD] flex flex-col justify-center items-center rounded-2xl shadow-sm gap-2 p-4">
                                <div class="relative w-[52px] h-[52px] flex items-center justify-center">
                                    <!-- Progress Circle -->
                                    <svg class="absolute top-0 left-0 w-full h-full -rotate-90 z-0">
                                        <circle cx="26" cy="26" r="24" stroke-width="4" stroke="#E5E7EB" fill="none" />
                                        <circle cx="26" cy="26" r="24" stroke-width="4" stroke="#3B82F6" fill="none" stroke-dasharray="150.79644737231007" stroke-dashoffset="{{ 150.79644737231007 * (1 - 0.25) }}" />
                                    </svg>

                                    <img src="{{ $user->avatar_url }}" alt="{{$user->name }}" class="w-12 h-12 rounded-full z-10" />
                                </div>

                                <h3 class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->position }}</p>

                                <div class="border border-gray-300 p-1 rounded-lg">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{$user->department}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-1/3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Nearest Events</h2>
                            <a href="{{ route('events.index') }}" class="text-blue-400 font-bold flex items-center justify-center gap-2 view_more">
                                View all

                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="flex flex-col gap-6">
                            @forelse($upcoming_events as $event)
                            <div class="flex items-center flex-col border-blue-500 border-l-4 p-2 bg-blue-50 py-4 space-y-4">
                                <div class="flex justify-between items-start w-full">
                                    <a href="{{ route('events.show', $event->id) }}" class="cursor-pointer">
                                        <p class="font-medium text-gray-900 dark:text-gray-100 w-1/2">{{ $event->title }}</p>
                                    </a>

                                    <div class="w-1/2 flex items-end justify-end">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6129 4.2097L12.7071 4.29289L17.7071 9.29289C18.0976 9.68342 18.0976 10.3166 17.7071 10.7071C17.3466 11.0676 16.7794 11.0953 16.3871 10.7903L16.2929 10.7071L13 7.415V19C13 19.5523 12.5523 20 12 20C11.4872 20 11.0645 19.614 11.0067 19.1166L11 19V7.415L7.70711 10.7071C7.34662 11.0676 6.77939 11.0953 6.3871 10.7903L6.29289 10.7071C5.93241 10.3466 5.90468 9.77939 6.2097 9.3871L6.29289 9.29289L11.2929 4.29289C11.6534 3.93241 12.2206 3.90468 12.6129 4.2097Z" fill="#FFBD21" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-start w-full">
                                    <p class="text-sm text-left text-gray-500 dark:text-gray-400 w-1/2">{{ \Carbon\Carbon::parse($event->start_date)->format('l | g:i A') }}</p>

                                    <div class="w-1/2 flex items-end justify-end">
                                        <div class="bg-[#FFBD21] p-1 rounded-lg flex items-center">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 4C16.4183 4 20 7.58172 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4ZM12 8C11.4477 8 11 8.44772 11 9V12.75L11.0068 12.8701C11.0496 13.2246 11.2801 13.5331 11.6152 13.6729L14.6152 14.9229L14.7256 14.9619C15.2068 15.0998 15.7255 14.858 15.9229 14.3848L15.9619 14.2744C16.0998 13.7932 15.858 13.2745 15.3848 13.0771L13 12.083V9L12.9932 8.88379C12.9354 8.38645 12.5128 8 12 8Z" fill="#7D8592" />
                                            </svg>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($event->start_date)->diffForHumans(null, true) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500 dark:text-gray-400">No upcoming events.</p>
                            @endforelse

                            <div class="flex items-center flex-col border-pink-500 border-l-4 p-2 bg-pink-50 py-4 space-y-4">
                                <div class="flex justify-between items-start w-full">
                                    <p class="font-medium text-gray-900 dark:text-gray-100 w-1/2">Anna's Birthday</h3>

                                    <div class="w-1/2 flex items-end justify-end">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6129 19.7903L12.7071 19.7071L17.7071 14.7071C18.0976 14.3166 18.0976 13.6834 17.7071 13.2929C17.3466 12.9324 16.7794 12.9047 16.3871 13.2097L16.2929 13.2929L13 16.585V5C13 4.44772 12.5523 4 12 4C11.4872 4 11.0645 4.38604 11.0067 4.88338L11 5V16.585L7.70711 13.2929C7.34662 12.9324 6.77939 12.9047 6.3871 13.2097L6.29289 13.2929C5.93241 13.6534 5.90468 14.2206 6.2097 14.6129L6.29289 14.7071L11.2929 19.7071C11.6534 20.0676 12.2206 20.0953 12.6129 19.7903Z" fill="#0AC947" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-start w-full">
                                    <p class="text-sm text-left text-gray-500 dark:text-gray-400 w-1/2">Today | 6:00 pm</p>

                                    <div class="w-1/2 flex items-end justify-end">
                                        <div class="bg-[#FFBD21] p-1 rounded-lg flex items-center ">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 4C16.4183 4 20 7.58172 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4ZM12 8C11.4477 8 11 8.44772 11 9V12.75L11.0068 12.8701C11.0496 13.2246 11.2801 13.5331 11.6152 13.6729L14.6152 14.9229L14.7256 14.9619C15.2068 15.0998 15.7255 14.858 15.9229 14.3848L15.9619 14.2744C16.0998 13.7932 15.858 13.2745 15.3848 13.0771L13 12.083V9L12.9932 8.88379C12.9354 8.38645 12.5128 8 12 8Z" fill="#7D8592" />
                                            </svg>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">5h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center flex-col border-pink-500 border-l-4 p-2 bg-pink-50 py-4 space-y-4">
                                <div class="flex justify-between items-start w-full">
                                    <p class="font-medium text-gray-900 dark:text-gray-100">Ryan's Birthday</h3>

                                    <div class="w-1/2 flex items-end justify-end">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6129 19.7903L12.7071 19.7071L17.7071 14.7071C18.0976 14.3166 18.0976 13.6834 17.7071 13.2929C17.3466 12.9324 16.7794 12.9047 16.3871 13.2097L16.2929 13.2929L13 16.585V5C13 4.44772 12.5523 4 12 4C11.4872 4 11.0645 4.38604 11.0067 4.88338L11 5V16.585L7.70711 13.2929C7.34662 12.9324 6.77939 12.9047 6.3871 13.2097L6.29289 13.2929C5.93241 13.6534 5.90468 14.2206 6.2097 14.6129L6.29289 14.7071L11.2929 19.7071C11.6534 20.0676 12.2206 20.0953 12.6129 19.7903Z" fill="#0AC947" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-start w-full">
                                    <p class="text-sm text-left text-gray-500 dark:text-gray-400 w-1/2">Tomorrow | 2:00 pm</p>

                                    <div class="w-1/2 flex items-end justify-end">
                                        <div class="bg-[#FFBD21] p-1 rounded-lg flex items-center ">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 4C16.4183 4 20 7.58172 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4ZM12 8C11.4477 8 11 8.44772 11 9V12.75L11.0068 12.8701C11.0496 13.2246 11.2801 13.5331 11.6152 13.6729L14.6152 14.9229L14.7256 14.9619C15.2068 15.0998 15.7255 14.858 15.9229 14.3848L15.9619 14.2744C16.0998 13.7932 15.858 13.2745 15.3848 13.0771L13 12.083V9L12.9932 8.88379C12.9354 8.38645 12.5128 8 12 8Z" fill="#7D8592" />
                                            </svg>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">5h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto space-y-4">
                <div class="flex gap-4">
                    <div class="w-2/3 p-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Projects</h2>
                            <a href="{{ route('projects.index') }}" class="text-blue-400 font-bold flex items-center justify-center gap-2 view_more">
                                View all

                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>

                        <!-- Project list here -->
                        @foreach($recent_projects as $project)
                        <div class="flex flex-row items-start bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm my-4" id="project-{{ $project->id }}">
                            <!-- Left column -->
                            <div class="w-1/2 flex  flex-col p-2 py-4 space-y-4 gap-4 border-r border-gray-300">
                                <div class="flex mb-4 text-left gap-4">
                                    <img src="{{ asset('images/project1.png') }}" class="w-12 h-12">

                                    <div class="">
                                        <h3 class="font-medium text-gray-900 dark:text-gray-100">PN000{{ $project->id }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $project->name }}</p>
                                        <!-- Medical App (iOS native) -->
                                    </div>
                                </div>

                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center justify-center gap-2 text-left text-gray-400 text-sm">
                                        <i class="fa-solid fa-calendar"></i>
                                        <span class="">Created {{ $project->formatted_created_at }}</span>
                                    </div>

                                    <div class="text-center gap-2 {{ $project->status == 'medium' ? 'text-[#FFBD21]' : 'text-[#0AC947]' }} flex items-center justify-center">
                                        <i class="fa-solid fa-arrow-up "></i>
                                        <span class="font-bold capitalize ">{{ $project->status }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Vertical Divider -->
                            <div class="w-px bg-gray-300 dark:bg-gray-600 mx-6"></div>

                            <!-- Right Column -->
                            <div class="w-1/2 flex flex-col p-2 py-4 space-y-4 rounded-md">
                                <h3 class="">Project Data</h3>

                                <div class="flex items-start justify-between">
                                    <div class="">
                                        <p class="text-sm text-gray-400">All tasks</p>
                                        <p class="text-sm">{{ $project->tasks->count() }}</p>
                                    </div>
                                    <div class="">
                                        <p class="text-sm text-gray-400">Active tasks</p>
                                        <p class="text-sm">{{ $project->active_tasks_count }}</p>
                                    </div>
                                    <div class="">
                                        <p class="text-sm text-gray-400">Assignees</p>
                                        <div class="flex items-center space-x-1 mt-1">
                                            <div class="flex -space-x-2">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <div class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center font-semibold ring-2 ring-white dark:ring-gray-800">+2</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="flex flex-row items-start bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm my-4">
                            <!-- Left column -->
                            <div class="w-1/2 flex  flex-col p-2 py-4 space-y-4">
                                <div class="flex mb-4 text-left gap-4">
                                    <img src="{{ asset('images/project2.png') }}" class="w-12 h-12">

                                    <div class="">
                                        <h3 class="font-medium text-gray-900 dark:text-gray-100">PN0001221</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Food Delivery Service</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center justify-center gap-2 text-left">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 1C16.5523 1 17 1.44772 17 2V3C19.2091 3 21 4.79086 21 7V17C21 19.2091 19.2091 21 17 21H7C4.79086 21 3 19.2091 3 17V7C3 4.79086 4.79086 3 7 3V2C7 1.44772 7.44772 1 8 1C8.55228 1 9 1.44772 9 2V3H15V2C15 1.44772 15.4477 1 16 1ZM8.99512 5.10254C8.94379 5.60667 8.51768 6 8 6C7.48232 6 7.05621 5.60667 7.00488 5.10254L7 5C5.9457 5 5.08229 5.81581 5.00586 6.85059L5 7V8H19V7C19 5.9457 18.1842 5.08229 17.1494 5.00586L17 5L16.9951 5.10254C16.9438 5.60667 16.5177 6 16 6C15.4823 6 15.0562 5.60667 15.0049 5.10254L15 5H9L8.99512 5.10254Z" fill="#7D8592" />
                                        </svg>
                                        <span class="text-gray-400 text-sm">Created Oct 10, 2023</span>
                                    </div>

                                    <div class="text-right text-[#FFBD21] flex items-center justify-center">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6129 4.2097L12.7071 4.29289L17.7071 9.29289C18.0976 9.68342 18.0976 10.3166 17.7071 10.7071C17.3466 11.0676 16.7794 11.0953 16.3871 10.7903L16.2929 10.7071L13 7.415V19C13 19.5523 12.5523 20 12 20C11.4872 20 11.0645 19.614 11.0067 19.1166L11 19V7.415L7.70711 10.7071C7.34662 11.0676 6.77939 11.0953 6.3871 10.7903L6.29289 10.7071C5.93241 10.3466 5.90468 9.77939 6.2097 9.3871L6.29289 9.29289L11.2929 4.29289C11.6534 3.93241 12.2206 3.90468 12.6129 4.2097Z" fill="#FFBD21" />
                                        </svg>
                                        <span class="font-bold">Medium</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Vertical Divider -->
                            <div class="w-px bg-gray-300 dark:bg-gray-600 mx-6"></div>

                            <!-- Right Column -->
                            <div class="w-1/2 flex flex-col p-2 py-4 space-y-4 rounded-md">
                                <h3 class="">Project Data</h3>

                                <div class="flex items-start justify-between">
                                    <div class="">
                                        <p class="text-sm text-gray-400">All tasks</p>
                                        <p class="text-sm">50</p>
                                    </div>
                                    <div class="">
                                        <p class="text-sm text-gray-400">Active tasks</p>
                                        <p class="text-sm">24</p>
                                    </div>
                                    <div class="">
                                        <p class="text-sm text-gray-400">Assignees</p>
                                        <div class="flex items-center space-x-1 mt-1">
                                            <div class="flex -space-x-2">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-row items-start bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm my-4">
                            <!-- Left column -->
                            <div class="w-1/2 flex  flex-col p-2 py-4 space-y-4">
                                <div class="flex mb-4 text-left gap-4">
                                    <img src="{{ asset('images/project2.png') }}" class="w-12 h-12">

                                    <div class="">
                                        <h3 class="font-medium text-gray-900 dark:text-gray-100">PN0001290</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Food Delivery Service</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center justify-center gap-2 text-left">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 1C16.5523 1 17 1.44772 17 2V3C19.2091 3 21 4.79086 21 7V17C21 19.2091 19.2091 21 17 21H7C4.79086 21 3 19.2091 3 17V7C3 4.79086 4.79086 3 7 3V2C7 1.44772 7.44772 1 8 1C8.55228 1 9 1.44772 9 2V3H15V2C15 1.44772 15.4477 1 16 1ZM8.99512 5.10254C8.94379 5.60667 8.51768 6 8 6C7.48232 6 7.05621 5.60667 7.00488 5.10254L7 5C5.9457 5 5.08229 5.81581 5.00586 6.85059L5 7V8H19V7C19 5.9457 18.1842 5.08229 17.1494 5.00586L17 5L16.9951 5.10254C16.9438 5.60667 16.5177 6 16 6C15.4823 6 15.0562 5.60667 15.0049 5.10254L15 5H9L8.99512 5.10254Z" fill="#7D8592" />
                                        </svg>
                                        <span class="text-gray-400 text-sm">Created May 23, 2023</span>
                                    </div>

                                    <div class="text-right text-[#0AC947] flex items-center justify-center">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6129 19.7903L12.7071 19.7071L17.7071 14.7071C18.0976 14.3166 18.0976 13.6834 17.7071 13.2929C17.3466 12.9324 16.7794 12.9047 16.3871 13.2097L16.2929 13.2929L13 16.585V5C13 4.44772 12.5523 4 12 4C11.4872 4 11.0645 4.38604 11.0067 4.88338L11 5V16.585L7.70711 13.2929C7.34662 12.9324 6.77939 12.9047 6.3871 13.2097L6.29289 13.2929C5.93241 13.6534 5.90468 14.2206 6.2097 14.6129L6.29289 14.7071L11.2929 19.7071C11.6534 20.0676 12.2206 20.0953 12.6129 19.7903Z" fill="#0AC947" />
                                        </svg>

                                        <span class="font-bold">Low</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Vertical Divider -->
                            <div class="w-px bg-gray-300 dark:bg-gray-600 mx-6"></div>

                            <!-- Right Column -->
                            <div class="w-1/2 flex flex-col p-2 py-4 space-y-4 rounded-md">
                                <h3 class="">Project Data</h3>

                                <div class="flex items-start justify-between">
                                    <div class="">
                                        <p class="text-sm text-gray-400">All tasks</p>
                                        <p class="text-sm">23</p>
                                    </div>
                                    <div class="">
                                        <p class="text-sm text-gray-400">Active tasks</p>
                                        <p class="text-sm">20</p>
                                    </div>
                                    <div class="">
                                        <p class="text-sm text-gray-400">Assignees</p>
                                        <div class="flex items-center space-x-1 mt-1">
                                            <div class="flex -space-x-2">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-6 h-6 rounded-full" alt="Member">
                                                <div class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center font-semibold ring-2 ring-white dark:ring-gray-800">+5</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-1/3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Activity Stream</h2>
                        </div>

                        <div id="activity-stream" class="flex items-center justify-center flex-col gap-4 w-full">
                            <div class="flex items-center justify-center p-2 w-full">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-12 h-12 rounded-full" alt="Member">
                                <div class="flex flex-col flex-1 px-2">
                                    <h3>Oscar Holloway</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">UI\UX Designer</p>
                                </div>
                            </div>

                            <div class="bg-[#F4F9FD] dark:bg-gray-900 flex p-6 items-center justify-center rounded-lg w-full gap-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.287 11.2928C11.6475 10.9326 12.2141 10.9049 12.6063 11.2098L12.701 11.2928L16.701 15.2928C17.0913 15.6832 17.0912 16.3163 16.701 16.7068C16.5442 16.8636 16.3481 16.9572 16.1444 16.9881C16.1334 16.9897 16.1223 16.9907 16.1112 16.992C16.0897 16.9945 16.0683 16.9967 16.0468 16.9978C15.8147 17.0087 15.5794 16.9396 15.3866 16.7898L15.2928 16.7068L14.7137 16.1277C14.7115 16.1278 14.7092 16.1276 14.7069 16.1277L12.994 14.4148V20.9998C12.994 21.5136 12.606 21.9365 12.1073 21.993C12.0815 21.9957 12.0555 21.9971 12.0292 21.9978C12.0185 21.9982 12.0077 21.9988 11.9969 21.9988C11.4855 21.9974 11.0646 21.6122 11.0067 21.116L10.9999 20.9998V16.1297C10.9979 16.1296 10.9959 16.1288 10.994 16.1287V14.4148L8.70105 16.7068C8.54424 16.8636 8.34811 16.9572 8.14441 16.9881C8.13336 16.9897 8.12229 16.9907 8.1112 16.992C8.08975 16.9945 8.0683 16.9967 8.04675 16.9978C7.81465 17.0087 7.57943 16.9396 7.3866 16.7898L7.29285 16.7068C7.0511 16.4651 6.95888 16.1299 7.01648 15.8172C7.01455 15.8169 7.01254 15.8165 7.01062 15.8162C7.03892 15.6632 7.10287 15.5153 7.203 15.3865L7.28699 15.2928L11.287 11.2928ZM2.90808 6.03593C4.30808 3.33593 7.20789 1.73593 10.2079 2.03593C13.2078 2.43597 15.708 4.63565 16.4081 7.63554H17.6083C19.608 7.63577 21.4077 9.13581 22.0077 11.1355C22.3076 12.5355 22.3074 14.3217 21.3094 15.0545C20.8381 15.4157 19.6081 15.6968 17.9882 15.8865C17.9614 15.4132 17.7696 14.9473 17.4081 14.5857L13.4081 10.5857L13.2684 10.4598L13.2206 10.4197C12.4281 9.80358 11.2941 9.87071 10.579 10.5857L6.57898 14.5857L6.45398 14.7254C6.22886 15.0139 6.09008 15.3372 6.0321 15.6658C5.11388 15.5049 4.31488 15.3027 3.70007 15.0545C1.4427 12.6554 1.7082 8.5359 2.90808 6.03593Z" fill="#3F8CFF" />
                                </svg>

                                <p class="flex-1 text-sm text-gray-500 dark:text-gray-400">Updated the status of Mind Map task to In Progress</p>
                            </div>

                            <div class="bg-[#F4F9FD] dark:bg-gray-900 flex p-6 items-center justify-center rounded-lg w-full gap-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2412 1.46512C14.1947 -0.488373 17.362 -0.488373 19.3154 1.46512C21.2097 3.35941 21.2671 6.395 19.4873 8.35882L19.3151 8.53972L10.1154 17.7293C8.94344 18.9013 7.04324 18.9013 5.87123 17.7293C4.7461 16.6042 4.7011 14.808 5.73658 13.6288L5.87165 13.4847L14.3616 5.0047C14.7524 4.61441 15.3856 4.61478 15.7759 5.00553C16.1361 5.36623 16.1635 5.93348 15.8583 6.32559L15.775 6.41975L7.28544 14.8993C6.89448 15.2903 6.89448 15.9242 7.28544 16.3151C7.64633 16.676 8.21419 16.7038 8.60722 16.3981L8.70161 16.3147L17.9012 7.12512C19.0737 5.95268 19.0737 4.05177 17.9012 2.87933C16.7757 1.75379 14.9788 1.70877 13.7995 2.74427L13.6554 2.87933L4.46544 12.0693C2.51152 14.0233 2.51152 17.1912 4.46544 19.1451C6.36016 21.0398 9.39642 21.0972 11.3603 19.3174L11.5412 19.1451L20.7312 9.95512C21.1218 9.56459 21.7549 9.56459 22.1454 9.95512C22.5059 10.3156 22.5337 10.8828 22.2286 11.2751L22.1454 11.3693L12.9554 20.5593C10.2205 23.2943 5.7862 23.2943 3.05123 20.5593C0.378415 17.8865 0.31767 13.5908 2.86899 10.8442L3.05123 10.6551L12.2412 1.46512Z" fill="#6D5DD3" />
                                </svg>

                                <p class="flex-1 text-sm text-gray-500 dark:text-gray-400">Attached files to the task</p>
                            </div>

                            <div class="flex items-center justify-center p-2 w-full">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="w-12 h-12 rounded-full" alt="Member">
                                <div class="flex flex-col flex-1 px-2">
                                    <h3>Emily Tyler</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Copywriter</p>
                                </div>
                            </div>

                            <div class="bg-[#F4F9FD] dark:bg-gray-900 flex p-6 items-center justify-center rounded-lg w-full gap-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.287 11.2928C11.6475 10.9326 12.2141 10.9049 12.6063 11.2098L12.701 11.2928L16.701 15.2928C17.0913 15.6832 17.0912 16.3163 16.701 16.7068C16.5442 16.8636 16.3481 16.9572 16.1444 16.9881C16.1334 16.9897 16.1223 16.9907 16.1112 16.992C16.0897 16.9945 16.0683 16.9967 16.0468 16.9978C15.8147 17.0087 15.5794 16.9396 15.3866 16.7898L15.2928 16.7068L14.7137 16.1277C14.7115 16.1278 14.7092 16.1276 14.7069 16.1277L12.994 14.4148V20.9998C12.994 21.5136 12.606 21.9365 12.1073 21.993C12.0815 21.9957 12.0555 21.9971 12.0292 21.9978C12.0185 21.9982 12.0077 21.9988 11.9969 21.9988C11.4855 21.9974 11.0646 21.6122 11.0067 21.116L10.9999 20.9998V16.1297C10.9979 16.1296 10.9959 16.1288 10.994 16.1287V14.4148L8.70105 16.7068C8.54424 16.8636 8.34811 16.9572 8.14441 16.9881C8.13336 16.9897 8.12229 16.9907 8.1112 16.992C8.08975 16.9945 8.0683 16.9967 8.04675 16.9978C7.81465 17.0087 7.57943 16.9396 7.3866 16.7898L7.29285 16.7068C7.0511 16.4651 6.95888 16.1299 7.01648 15.8172C7.01455 15.8169 7.01254 15.8165 7.01062 15.8162C7.03892 15.6632 7.10287 15.5153 7.203 15.3865L7.28699 15.2928L11.287 11.2928ZM2.90808 6.03593C4.30808 3.33593 7.20789 1.73593 10.2079 2.03593C13.2078 2.43597 15.708 4.63565 16.4081 7.63554H17.6083C19.608 7.63577 21.4077 9.13581 22.0077 11.1355C22.3076 12.5355 22.3074 14.3217 21.3094 15.0545C20.8381 15.4157 19.6081 15.6968 17.9882 15.8865C17.9614 15.4132 17.7696 14.9473 17.4081 14.5857L13.4081 10.5857L13.2684 10.4598L13.2206 10.4197C12.4281 9.80358 11.2941 9.87071 10.579 10.5857L6.57898 14.5857L6.45398 14.7254C6.22886 15.0139 6.09008 15.3372 6.0321 15.6658C5.11388 15.5049 4.31488 15.3027 3.70007 15.0545C1.4427 12.6554 1.7082 8.5359 2.90808 6.03593Z" fill="#3F8CFF" />
                                </svg>

                                <p class="text-sm text-gray-500 dark:text-gray-400">Updated the status of Mind Map task to In Progress</p>
                            </div>

                            <div>
                                <a class="text-blue-400 font-bold flex items-center justify-center gap-2" class="view_more">
                                    View more

                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 4L6 9L10 4" stroke="#3F8CFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>