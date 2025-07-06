<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between w-full">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Projects') }}
                </h2>

                <x-primary-button href="{{ route('projects.create') }}">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                    Add Project
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <!-- Main Content Area -->
    <div class="space-y-8">
        <div class="max-w-7xl mx-auto flex gap-4">
            <div class="flex flex-col lg:flex-row lg:space-x-6">
                <!-- Left Panel: Current Projects -->
                <div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="flex items-center justify-between border-b border-gray-300 dark:border-gray-600 px-4 py-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Current Projects</h3>
                        <a href="{{ route('projects.show', 1) }}"
                            class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-500 transition">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="flex flex-col divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="border-r-4 border-blue-500 bg-blue-50 dark:bg-blue-900 p-4 flex flex-col gap-1">
                            <p class="font-semibold text-gray-800 dark:text-gray-100">PN0001265</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Medical App (iOS native)</span>
                            <a href="{{ route('projects.show', 1) }}"
                                class="mt-2 text-blue-600 dark:text-blue-400 font-semibold text-sm flex items-center space-x-1 hover:underline">
                                <span>View details</span>
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>

                        @foreach ($projects as $project)
                        <div class="p-4 flex flex-col gap-1">
                            <p class="font-semibold text-gray-800 dark:text-gray-100">PN000{{ $project->id }}</p>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $project->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Panel: Tasks -->
                <div class="w-full lg:w-3/4 lg:mt-0 flex flex-col h-full overflow-hidden">
                    <div class="flex items-center justify-between px-4">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">Tasks</h3>

                        <div class="flex items-center space-x-2">
                            <div id="listViewBtn" class="bg-white dark:bg-gray-700 rounded-lg p-2 hover:text-gray-700 dark:hover:text-gray-300 cursor-pointer transition" onclick="showView('list')">
                                <i class="fas fa-bars p-2"></i>
                            </div>
                            <div id="boardViewBtn" class="bg-white dark:bg-gray-700 rounded-lg p-2 hover:text-gray-700 dark:hover:text-gray-300 cursor-pointer transition" onclick="showView('board')">
                                <i class="fas fa-chart-bar p-2"></i>
                            </div>
                            <div id="timelineViewBtn" class="bg-white dark:bg-gray-700 rounded-lg p-2 hover:text-gray-700 dark:hover:text-gray-300 cursor-pointer transition" onclick="showView('timeline')">
                                <i class="fa-solid fa-sliders p-2"></i>
                            </div>

                            <div class="bg-white dark:bg-gray-700 rounded-lg p-2 cursor-pointer hover:text-gray-700 dark:hover:text-gray-300 transition" onclick="toggleFilter()">
                                <i class="fas fa-filter p-2"></i>
                            </div>
                        </div>
                    </div>

                    <div id="list" class="px-4 mt-4 hidden">
                        <h4 class="bg-gray-200 dark:bg-gray-700 rounded-xl p-2 text-center font-semibold text-gray-700 dark:text-gray-200 mb-4">Active Tasks</h4>

                        @foreach($activeTasks as $task)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-2 grid grid-cols-7 items-center my-4 w-full gap-x-4">
                            <div class="flex flex-col items-center justify-start">
                                
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Task Name</p>
                                <p class="text-black dark:text-white">{{ $task->title }}</p>
                            </div>

                            <div class="flex flex-col items-center justify-start">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Estimate</p>
                                <p class="text-black dark:text-white">{{ $task->formatHoursToDaysHours($task->estimate ?? 0) }}</p>
                            </div>

                            <div class="flex flex-col items-center justify-start">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Spent Time</p>
                                <p class="text-black dark:text-white">{{ $task->formatHoursToDaysHours($task->spent_time ?? 0) }}</p>
                            </div>

                            <div class="flex flex-col items-center justify-start">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Assignee</p>
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $task->assigned_to }}" alt="Team Member" class="w-6 h-6 border-gray-200 dark:border-gray-600 border rounded-full z-10" />
                            </div>

                            <!-- Priority -->
                            <div class="flex flex-col items-center justify-start">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Priority</p>
                                <x-priority-indicator :priority="$task->priority" />
                            </div>

                            <!-- Status -->
                            <div class="
                                @if($task->status === 'done') bg-green-50 dark:bg-green-900 text-green-500 dark:text-green-300
                                @elseif($task->status === 'in_progress') bg-yellow-50 dark:bg-yellow-900 text-yellow-500 dark:text-yellow-300
                                @else bg-red-50 dark:bg-red-900 text-red-500 dark:text-red-300
                                @endif
                                rounded-lg p-2 font-medium
                            ">
                                <span class="capitalize">{{ str_replace('_', ' ', $task->status) }}</span>
                            </div>

                            <!-- Progress Circle (Placeholder for now) -->
                            <div class="p-2 m-2">
                                <div class="relative w-6 h-6">
                                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                        <!-- Background circle -->
                                        <path class="text-gray-200 dark:text-gray-700" stroke="currentColor" stroke-width="4" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <!-- Progress circle (100% as example) -->
                                        <path class="text-blue-500 dark:text-blue-400" stroke="currentColor" stroke-width="4" stroke-dasharray="100, 100" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Backlogs -->
                        <h4 class="bg-gray-200 dark:bg-gray-700 rounded-xl p-2 text-center font-semibold text-gray-700 dark:text-gray-200 mb-4">Backlogs</h4>

                        @foreach($backlogTasks as $task)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-2 flex items-center justify-between my-4 w-full">
                            <!-- Task Name -->
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Task Name</p>
                                <p class="text-black dark:text-white">{{ $task->title }}</p>
                            </div>

                            <!-- Estimate -->
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Estimate</p>
                                <p class="text-black dark:text-white">{{ $task->formatHoursToDaysHours($task->estimate ?? 0) }}</p>
                            </div>

                            <!-- Spent Time -->
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Spent Time</p>
                                <p class="text-black dark:text-white">{{ $task->formatHoursToDaysHours($task->spent_time ?? 0) }}</p>
                            </div>

                            <!-- Assignee -->
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Assignee</p>
                                @php
                                $assignee = \App\Models\User::find($task->assigned_to);
                                @endphp
                                @if($assignee)
                                <img src="{{ $assignee->profile_photo_url ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . rand(1,1000) }}" alt="{{ $assignee->name }}" class="w-6 h-6 border-gray-200 border rounded-full z-10" />
                                @else
                                <p class="text-gray-500 text-xs">Unassigned</p>
                                @endif
                            </div>

                            <!-- Priority -->
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-gray-400 dark:text-gray-300 text-sm">Priority</p>
                                <x-priority-indicator :priority="$task->priority" />
                            </div>

                            <!-- Progress Circle -->
                            <div class="p-2 m-2">
                                <x-progress-circle :progress="$task->progress ?? 0" />
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div id="board" class="flex-1 overflow-hidden">
                        <h4 class="mt-6 bg-gray-200 dark:bg-gray-700 rounded-xl p-2 text-center font-semibold text-gray-700 dark:text-gray-200 mb-4 transition">
                            Active Tasks
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 py-2 w-full">
                            @php
                            // Group activeTasks by their status (assuming task has a 'status' attribute)
                            $groupedActiveTasks = $activeTasks->groupBy('status');
                            $statuses = ['todo' => 'To Do', 'inprogress' => 'In Progress', 'inreview' => 'In Review', 'done' => 'Done'];
                            @endphp

                            @foreach ($statuses as $statusKey => $statusLabel)
                            <div class="flex-col flex gap-2 task-column" data-id="{{ $statusKey }}">
                                <div class="border-2 border-gray-100 rounded-full p-4 bg-gray-50 w-full text-center font-medium hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-800 mb-4 text-gray-700 dark:text-gray-300">
                                    {{ $statusLabel }}
                                </div>

                                @if(isset($groupedActiveTasks[$statusKey]))
                                @foreach ($groupedActiveTasks[$statusKey] as $task)
                                <div class="bg-white dark:bg-gray-800 p-4 flex flex-col items-start gap-2 rounded-xl shadow task-card">
                                    <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ $task->code ?? 'TS000000' }}</span>
                                    <span class="text-gray-800 dark:text-gray-200">{{ $task->title }}</span>

                                    <div class="flex items-center justify-between w-full mt-2">
                                        <div class="flex items-center gap-1">
                                            <span class="bg-blue-50 dark:bg-blue-900 text-gray-600 dark:text-blue-300 text-xs px-2 py-1 rounded-lg">{{ $task->duration ?? 'N/A' }}</span>
                                            <i class="fas fa-arrow-up text-yellow-400 dark:text-yellow-300 text-sm"></i>
                                        </div>
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p class="text-gray-500 dark:text-gray-400">No tasks</p>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <div class="bg-gray-200 dark:bg-gray-900 rounded-xl px-6 py-2 text-center flex flex-col items-center justify-center gap-4 shadow mt-8">
                            <h4 class="rounded-xl text-center font-semibold text-gray-700 dark:text-gray-200 mb-4">Backlogs</h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
                                @forelse ($backlogTasks as $task)
                                <div class="bg-white dark:bg-gray-800 p-4 flex flex-col items-start gap-2 rounded-xl shadow">
                                    <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ $task->code ?? 'TS000000' }}</span>
                                    <span class="text-gray-800 dark:text-gray-200">{{ $task->title }}</span>

                                    <div class="flex items-center justify-between w-full mt-2">
                                        <div class="flex items-center gap-1">
                                            <span class="bg-blue-50 dark:bg-blue-900 text-gray-600 dark:text-blue-300 text-xs px-2 py-1 rounded-lg">{{ $task->duration ?? 'N/A' }}</span>
                                            <i class="fas fa-arrow-down text-green-400 dark:text-green-300 text-sm"></i>
                                        </div>
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-500 dark:text-gray-400">No backlog tasks found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div id="timeline" class="p-4">
                    <!-- Task Rows -->
                    @php
                    $tasks = [ 'Research', 'Mind Map', 'UX Login + Registration', 'UI Kit', 'Testing', 'Client Feedback', 'Bug Fixing', 'Moodboard', 'Reports', 'Final Review'];

                    // Get current month's dates
                    $currentMonth = now();
                    $daysInMonth = $currentMonth->daysInMonth;
                    @endphp

                    <!-- Timeline Header -->
                    <div class="flex bg-white rounded-lg p-2 overflow-x-auto">
                        <!-- Fixed Task Label Header -->
                        <div class="w-[200px] shrink-0 bg-white border-r-2 border-b-2 border-r-gray-200 border-b-gray-200 font-semibold text-left p-2 flex items-center justify-between">
                            <div class="flex flex-col">
                                All Tasks
                                <span class="text-sm text-gray-500 pt-4">(10 tasks)</span>
                            </div>
                            <i class="fas fa-angle-right self-center mt-2 px-2"></i>
                        </div>

                        <!-- Scrollable Date Header -->
                        <div class="overflow-x-auto w-full border-b-2 border-b-gray-200">
                            <div class="grid w-full">
                                <div class="col-span-31  text-center p-2 font-medium"> First Month (May)</div>
                            </div>
                            <div class="grid gap-2 rounded-lg p-2" style="grid-template-columns: repeat({{ $daysInMonth }}, minmax(40px, 1fr));">
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                <div class="text-sm text-center p-2 bg-blue-50 rounded-lg text-gray-500 font-bold">
                                    {{ $day }}
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($tasks as $task)
                <div class="flex bg-white border-b-2 border-b-gray-200 transition-all duration-200">
                    <div class="w-[200px] shrink-0 bg-white border-r-2 border-r-gray-200 font-semibold text-left p-4 mx-2 flex items-center justify-between">
                        {{ $task }}
                    </div>

                    <div class="grid gap-2 rounded-lg"
                        style="grid-template-columns: repeat({{ $daysInMonth }}, minmax(40px, 1fr));"
                        data-task="{{ $task }}">
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <div class="task-day p-2 m-1 rounded-lg cursor-pointer transition-all duration-200 text-blue-100 bg-blue-50"
                            data-task="{{ $task }}"
                            data-day="{{ $day }}"
                            onclick="handleTaskDay(this)">{{$day}}</div>
                    @endfor
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
    </div>
    </div>

    <x-modal name="filter-modal" :show="false" maxWidth="lg" position="right">
        <div id="filterPanel" class="p-6 translate-x-full transition-transform duration-300 ease-in-out bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            <div class="flex justify-between items-center mb-4 border-b border-b-gray-100 dark:border-b-gray-700 gap-4">
                <h3 class="text-lg font-semibold">Filters</h3>
                <button onclick="toggleFilter()" class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="space-y-4">
                <!-- Period -->
                <div class="border-b border-b-gray-100 dark:border-b-gray-700 py-4">
                    <x-input-label for="period" :value="__('Period')" />
                    <x-text-input id="period" class="block mt-1 w-full" type="date" name="period" :value="old('period')" required autofocus autocomplete="date" />
                    <x-input-error :messages="$errors->get('period')" class="mt-2" />
                </div>

                <!-- Task Group -->
                <div class="border-b border-b-gray-100 dark:border-b-gray-700 py-4 flex-col flex gap-4">
                    <p class="text-md text-gray-500 dark:text-gray-300 font-semibold">Task Group</p>
                    @foreach(['design' => 'Design', 'development' => 'Development', 'testing' => 'Testing', 'marketing' => 'Marketing', 'project_management' => 'Project Management'] as $id => $label)
                    <label for="{{ $id }}" class="inline-flex items-center space-x-2">
                        <x-checkbox id="{{ $id }}" name="task_group" :value="old('task_group')" />
                        <span>{{ $label }}</span>
                    </label>
                    @endforeach
                </div>

                <!-- Reporter -->
                <div class="border-b border-b-gray-100 dark:border-b-gray-700 py-4 flex-col flex gap-4">
                    <p class="text-md text-gray-500 dark:text-gray-300 font-semibold">Reporter</p>
                    @foreach(['oscar_holloway' => 'Oscar Holloway', 'leonard_rodriguez' => 'Leonard Rodriguez', 'owen_chambers' => 'Owen Chambers', 'gabriel_flowers' => 'Gabriel Flowers', 'violet_robbins' => 'Violet Robbins'] as $id => $name)
                    <label for="{{ $id }}" class="inline-flex items-center space-x-2">
                        <x-checkbox id="{{ $id }}" name="reporter" :value="old('reporter')" />
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                        <span>{{ $name }}</span>
                    </label>
                    @endforeach
                    <p class="text-md text-blue-400 dark:text-blue-300 underline font-semibold">View more <i class="fas fa-angle-down px-1"></i></p>
                </div>

                <!-- Assignees -->
                <div class="border-b border-b-gray-100 dark:border-b-gray-700 py-4">
                    <p class="text-md text-gray-500 dark:text-gray-300 font-semibold">Assignees</p>
                    <x-text-input id="assignees" class="block mt-1 w-full" type="text" name="assignees" :value="old('assignees')" required autofocus autocomplete="assignees" />

                    <div class="grid grid-cols-2 gap-4 py-2">
                        @foreach(['Violet Robbins', 'Ronald Robbins', 'Birdie Garner', 'Marvin Cooper'] as $assignee)
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-1 text-sm flex items-center justify-center gap-2">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                            <span>{{ $assignee }}</span>
                            <i class="fas fa-times-circle"></i>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Estimate -->
                <div class="py-2">
                    <x-input-label for="estimate" :value="__('Estimate')" />
                    <x-text-input id="estimate" class="block mt-1 w-full" type="text" name="estimate" :value="old('estimate')" required autofocus autocomplete="assignees" />
                    <x-input-error :messages="$errors->get('assignees')" class="mt-2" />
                </div>

                <!-- Priority -->
                <div class="py-2">
                    <x-input-label for="priority" :value="__('Priority')" />
                    <x-text-input id="priority" class="block mt-1 w-full" type="text" name="priority" :value="old('priority')" required autofocus autocomplete="assignees" />
                    <x-input-error :messages="$errors->get('assignees')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between pt-6">
                <div class="flex items-center justify-center text-sm text-gray-600 dark:text-gray-300">
                    <i class="fas fa-info-circle px-2"></i>
                    10 matches found
                </div>
                <button onclick="toggleFilter()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save Filters (3)
                </button>
            </div>
        </div>
    </x-modal>


    <style>
        .active {
            background-color: #3b82f6;
            /* Tailwind blue-500 */
            color: white !important;
        }

        #filterPanel {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .task-card {
            cursor: grab;
        }

        .task-card:active {
            cursor: grabbing;
        }
    </style>

    @push('scripts')
    <script>
        function toggleFilter() {
            const modal = document.getElementById('modal-filter-modal');
            const isOpen = modal && modal.getAttribute('aria-hidden') === 'false';

            if (isOpen) {
                window.dispatchEvent(new CustomEvent('close-modal', {
                    detail: 'filter-modal'
                }));
            } else {
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'filter-modal'
                }));
            }
        }

        function showView(viewId) {
            $('#list, #board, #timeline').hide();
            $('#listViewBtn, #boardViewBtn, #timelineViewBtn').removeClass('active');
            $('#' + viewId + 'ViewBtn').addClass('active');
            $('#' + viewId).show();
        }

        const tasks = [{
                name: "Research",
                start: 1,
                duration: Math.floor(Math.random() * 4) + 2
            },
            {
                name: "Mind Map",
                start: 4,
                duration: Math.floor(Math.random() * 3) + 2
            },
            {
                name: "UX Login + Registration",
                start: 8,
                duration: Math.floor(Math.random() * 5) + 3
            },
            {
                name: "Testing",
                start: 13,
                duration: Math.floor(Math.random() * 4) + 2
            },
            {
                name: "Client Feedback",
                start: 16,
                duration: Math.floor(Math.random() * 3) + 1
            },
            {
                name: "Moodboard",
                start: 18,
                duration: Math.floor(Math.random() * 4) + 2
            },
            {
                name: "Reports",
                start: 22,
                duration: Math.floor(Math.random() * 3) + 2
            },
            {
                name: "Final Review",
                start: 25,
                duration: Math.floor(Math.random() * 3) + 1
            }
        ];



        // Show the list view by default when the page loads using jQuery's ready function
        $(document).ready(function() {
            showView('board');
            window.toggleFilter = toggleFilter;
            initializeTaskDays();

            const placeholderHTML = '<div class="drop-placeholder h-20 border-2 border-dashed border-gray-300 rounded-xl my-2"></div>';

            $('.task-column').each(function() {
                new Sortable(this, {
                    group: 'shared',
                    animation: 150,
                    ghostClass: 'bg-blue-100',

                    onStart: function(evt) {
                        // Add placeholder to each column
                        $('.task-column').each(function() {
                            $(this).append(placeholderHTML);
                        });
                    },

                    onEnd: function(evt) {
                        const task = evt.item;
                        const newColumn = $(evt.to).data('id');

                        console.log(`Task moved to: ${newColumn}`);

                        $('.drop-placeholder').remove();
                    }
                });
            });

            tasks.forEach(task => {
                const $row = $(`div[data-task="${task.name}"]`);
                const $cells = $row.children();
                for (let i = 0; i < task.duration; i++) {
                    $cells.eq(task.start - 1 + i).remove();
                }
                const $taskBlock = $(`<div class="bg-blue-500 col-span-${task.duration} rounded text-xs text-white text-center flex items-center justify-center" style="grid-column: span ${task.duration};">`).text(task.name);
                $cells.eq(task.start - 1).before($taskBlock);
            });


        });

        function initializeTaskDays() {
            $('.task-day').each(function() {
                const $this = $(this);
                const taskName = $this.data('task');
                const day = parseInt($this.data('day'));
                // updateTaskDayStyle($this, isTaskActive(taskName, day));
                if (isTaskActive(taskName, day)) {
                    $this.removeClass('bg-blue-50 text-blue-100').addClass('bg-blue-500 text-white active');
                }
            });
        }

        function updateTaskDayStyle($element, isActive) {
            if (isActive) {
                console.log('vvv')
                $element.addClass('active bg-blue-500 text-white').removeClass('bg-blue-50 text-blue-100');
            } else {
                console.log('aaa')
                $element.removeClass('active bg-blue-500 text-white').addClass('bg-blue-50 text-blue-100');
            }
        }

        function isTaskActive(taskName, day) {
            const task = tasks.find(t => t.name === taskName);
            if (!task) return false;
            return day >= task.start && day < (task.start + task.duration);
        }
    </script>
    @endpush
</x-app-layout>