<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col w-full">
                <a href="{{ route('projects.index') }}" class="flex items-start justify-start text-blue-400 font-bold gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to projects
                </a>

                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        {{ $project->name }}
                        <span class="text-gray-500 text-md">PN000{{ $project->id }}</span>
                    </h2>

                    <div class="flex items-center gap-4">
                        <x-primary-button theme="blue"><i class="fas fa-plus px-2"></i> Add Task</x-primary-button>
                        <x-primary-button theme="red"><i class="fas fa-trash px-2"></i> Delete</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mb-4 mx-auto px-2">
        <div class="flex flex-col lg:flex-row lg:space-x-6">
            <!-- Left Panel: Current Projects -->
            <div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="flex flex-col divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="p-4 m-4 flex flex-col gap-4 space-y-4">
                        <div class="flex items-center justify-between py-4">
                            <div class="flex flex-col ">
                                <p class="text-sm text-gray-500 dark:text-gray-100">Project code</p>
                                <p class=" dark:text-gray-100">PN000{{ $project->id }}</p>
                            </div>
                            <div class="text-sm bg-blue-50 rounded-lg align-top p-2 text-blue-400 dark:bg-gray-700 dark:hover:bg-gray-500 dark:text-gray-300">
                                <i class="fa fa-edit p-2"></i>
                            </div>
                        </div>

                        <div class="">
                            <span class="text-sm text-gray-800 dark:text-gray-400">Description</span>
                            <p class="">{{ $project->description }}</p>
                        </div>

                        <div class="">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Reporter</span>
                            <div class="flex items-center justify-start gap-2">
                                <img src="{{ url($project->manager->avatar_url ) }}" alt="{{  $project->manager->name }}" class="w-6 h-6 border-gray-200 border rounded-full z-10" />
                                <p class="font-semibold text-gray-800 dark:text-gray-100">{{  $project->manager->name }}</p>
                            </div>
                        </div>

                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Assignees</span>
                            <div class="flex items-center justify-start space-x-1 mt-1">
                                @php
                                    $visibleAssignees = $assignments->take(3);
                                    $remainingCount = $assignments->count() - $visibleAssignees->count();
                                @endphp

                                @foreach($visibleAssignees as $assignee)
                                    <img src="{{ url($assignee->user->avatar_url) }}"  alt="{{ $assignee->user->name }}"  class="w-6 h-6 border border-gray-200 rounded-full object-cover" />
                                @endforeach

                                @if($remainingCount > 0)
                                    <div class="w-6 h-6 flex items-center justify-center rounded-full bg-blue-500 text-white text-xs font-semibold" title="+{{ $remainingCount }} more">
                                        +{{ $remainingCount }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dead Line</p>
                            <span class="font-bold text-gray-800 dark:text-gray-100"> {{ $project->formatted_deadline }}</span>
                        </div>

                        <span class="text-sm text-gray-500 dark:text-gray-100"><i class="fas fa-calendar p-2"></i> Created {{ $project->formatted_created_at }}</span>

                        <div class="flex items-center justify-start gap-4">
                            <div class="p-2 font-bold rounded-lg bg-purple-100 text-purple-600 cursor-pointer hover:bg-purple-200 transition-colors duration-200" onclick="document.getElementById('file_attachment').click()">
                                <i class="fas fa-paperclip p-2"></i>
                                <input type="file" id="file_attachment" name="attachments[]" class="hidden" multiple onchange="handleFileSelect(this)">
                            </div>
                            <div class="p-2 font-bold rounded-lg bg-blue-100 text-blue-400 cursor-pointer hover:bg-blue-200 transition-colors duration-200" onclick="addProjectLink()">
                                <i class="fas fa-link p-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Tasks -->
            <div class="w-full lg:w-3/4 lg:mt-0 flex flex-col h-full overflow-hidden">
                <!-- Header/Filters     -->
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
                    </div>

                    <div class="bg-white dark:bg-gray-700 rounded-lg p-2 cursor-pointer hover:text-gray-700 dark:hover:text-gray-300 transition" onclick="toggleFilter()">
                        <i class="fas fa-filter p-2"></i>
                    </div>
                </div>

                <!-- Filter Section -->
                <div id="list" class="flex-1 px-4 mt-4 hidden">
                    <h4 class="bg-gray-200 dark:bg-gray-700 rounded-xl p-2 text-center font-semibold text-gray-700 dark:text-gray-200 mb-4">Active Tasks</h4>

                    @foreach($activeTasks as $task)
                    <a href="{{ route('tasks.show', $task->id) }}" class="hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 items-center my-4 w-full gap-x-4 gap-y-4 text-gray-800 dark:text-gray-200">
                            <div class="flex items-center justify-center space-x-2">
                                <p class="m-0">{{ $task->title }}</p>
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Estimate</p>
                                <p class="m-0">{{ $task->formatHoursToDaysHours($task->estimate ?? 0) }}</p>
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Spent Time</p>
                                <p class="m-0">{{ $task->formatHoursToDaysHours($task->spent_time ?? 0) }}</p>
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Assignee</p>
                                <img src="{{ $task->assignee->avatar }}" alt="{{ $task->assignee->name }}" class="w-6 h-6 border-gray-200 dark:border-gray-700 border rounded-full z-10" />
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Priority</p>
                                <x-priority-indicator :priority="$task->priority" />
                            </div>

                            <div class="rounded-lg p-2 font-medium flex items-center justify-center {{ $task->status_classes }}">
                                <span>{{ $task->status }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach

                    <h4 class="bg-gray-200 dark:bg-gray-700 rounded-xl p-2 text-center font-semibold text-gray-700 dark:text-gray-200 my-4">Backlogs</h4>

                    @foreach($backlogTasks as $task)
                    <a href="{{ route('tasks.show', $task->id) }}" class="hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 items-center my-4 w-full gap-x-4 gap-y-4 text-gray-800 dark:text-gray-200">
                            <div class="flex items-center justify-center space-x-2">
                                <p class="m-0">{{ $task->title }}</p>
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Estimate</p>
                                <p class="m-0">{{ $task->formatHoursToDaysHours($task->estimate ?? 0) }}</p>
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Spent Time</p>
                                <p class="m-0">{{ $task->formatHoursToDaysHours($task->spent_time ?? 0) }}</p>
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Assignee</p>
                                <img src="{{ $task->assignee->avatar }}" alt="{{ $task->assignee->name }}" class="w-6 h-6 border-gray-200 dark:border-gray-700 border rounded-full z-10" />
                            </div>

                            <div class="flex items-center justify-center space-x-2">
                                <p class="text-gray-400 dark:text-gray-400 text-sm whitespace-nowrap">Priority</p>
                                <x-priority-indicator :priority="$task->priority" />
                            </div>

                            <div class="rounded-lg p-2 font-medium flex items-center justify-center {{ $task->status_classes }}">
                                <span>{{ $task->status }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                <div id="board" class="flex-1 overflow-hidden hidden">
                    @php
                        $groupedActiveTasks = $activeTasks->groupBy(function($task) {
                            return strtolower(str_replace(' ', '_', $task->status));
                        });

                        $groupedBacklogTasks = $backlogTasks->groupBy(function($task) {
                            return strtolower(str_replace(' ', '_', $task->status));
                        });
                    @endphp
                    
                    {{-- Header Labels --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 py-4 w-full">
                        @foreach (['todo' => 'To Do', 'in_progress' => 'In Progress', 'review' => 'In Review', 'completed' => 'Done'] as $key => $label)
                            <div class="border-2 border-gray-100 dark:border-gray-700 rounded-full p-4 bg-gray-50 dark:bg-gray-800 w-full text-center font-medium hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                                {{ $label }}
                            </div>
                        @endforeach
                    </div>

                    <div class="w-full text-center mb-4">
                        <h4 class="bg-gray-200 dark:bg-gray-700 rounded-xl p-2 text-center font-semibold text-gray-700 dark:text-gray-200 mb-4">Active Tasks</h4>
                    </div>

                    {{-- Columns for tasks --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 py-4 w-full">
                        @foreach (['todo', 'in_progress', 'review', 'completed'] as $status)
                            <div class="flex flex-col gap-2 task-column " data-id="{{ $status }}">
                                @forelse ($groupedActiveTasks[$status] ?? [] as $task)
                                    <div class="bg-white dark:bg-gray-800 p-4 flex flex-col items-start gap-2 rounded-xl shadow task-card m-2">
                                        <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">TS000{{ $task->id }}</span>
                                        <span class="text-gray-800 dark:text-gray-100">{{ $task->title }}</span>

                                        <div class="flex items-center justify-between w-full mt-2">
                                            <div class="flex items-center gap-1">
                                                <span class="bg-blue-50 dark:bg-blue-900 text-gray-600 dark:text-gray-300 text-xs px-2 py-1 rounded-lg">
                                                    {{ $task->estimate ?? '0d' }}
                                                </span>
                                                <x-priority-indicator :priority="$task->priority" />
                                            </div>
                                            <img src="{{ $task->assignee->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . rand(1, 1000) }}"
                                                class="rounded-full h-6 w-6 object-contain" alt="{{ $task->assignee->name ?? 'Assignee' }}">
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No tasks</p>
                                @endforelse
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-200 dark:bg-gray-800 rounded-xl px-6 py-2 text-center flex flex-col items-center justify-center gap-4 shadow">
                        <h4 class="rounded-xl text-center font-semibold text-gray-700 dark:text-gray-200 mb-4">Backlogs</h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
                            @foreach (['todo', 'in_progress', 'review', 'completed'] as $status)
                                <div class="task-column" data-id="{{ $status }}">
                                    @forelse ($groupedBacklogTasks[$status] ?? [] as $task)
                                        <div class="bg-white dark:bg-gray-900 p-4 flex flex-col items-start gap-2 rounded-xl shadow">
                                            <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">TS000{{ $task->id }}</span>
                                            <span class="text-gray-800 dark:text-gray-100">{{ $task->title }}</span>

                                            <div class="flex items-center justify-between w-full mt-2">
                                                <div class="flex items-center gap-1">
                                                    <span class="bg-blue-50 dark:bg-blue-900 text-gray-600 dark:text-gray-300 text-xs px-2 py-1 rounded-lg">8h</span>
                                                    <i class="fas fa-arrow-down text-green-400 text-sm"></i>
                                                </div>
                                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain" alt="Assignee Avatar">
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No tasks</p>
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div id="timeline" class="mt-4 overflow-x-auto">
                    @php
                        $currentMonth = now();
                        $daysInMonth = $currentMonth->daysInMonth;
                    @endphp

                    <!-- Timeline Header & Rows container -->
                    <div class="min-w-max">
                        <div class="flex border-b border-gray-200 dark:border-gray-700">
                            <div class="w-[200px] flex-shrink-0 p-2 border-r border-gray-200 dark:border-gray-700 font-semibold text-left flex items-center justify-between">
                                <div class="flex flex-col">
                                    All Tasks
                                    <span class="text-sm text-gray-500 dark:text-gray-400 pt-1">({{ $tasks->count() }} tasks)</span>
                                </div>
                                <i class="fas fa-angle-right px-2 text-gray-400 dark:text-gray-500"></i>
                            </div>

                            <!-- Days Header -->
                            <div class="grid grid-cols-{{ $daysInMonth }} min-w-[calc(40px*{{ $daysInMonth }})] gap-2 p-2">
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <label class="text-center text-sm font-bold text-gray-600 dark:text-gray-300 bg-blue-50 dark:bg-blue-900 rounded-lg">
                                    {{ $day }}
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <!-- Task Rows -->
                        @foreach ($tasks as $task)
                            <div class="flex border-b border-gray-200 dark:border-gray-700">
                                <div class="w-[200px] flex-shrink-0 p-4 border-r border-gray-200 dark:border-gray-700 font-semibold text-left flex items-center">
                                {{ $task }}
                                </div>

                                <div class="grid grid-cols-{{ $daysInMonth }} min-w-[calc(40px*{{ $daysInMonth }})] gap-2 p-2">
                                @for ($day = 1; $day <= $daysInMonth; $day++)
                                    <label class="cursor-pointer rounded-lg text-blue-700 dark:text-blue-400 bg-blue-100 dark:bg-blue-800 p-2 text-center transition duration-200 hover:bg-blue-200 dark:hover:bg-blue-700" data-task="{{ $task->id }}" data-day="{{ $day }}" onclick="handleTaskDay(this)">
                                    {{ $day }}
                                    </label>
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
        <div id="filterPanel" class="p-6 translate-x-full transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-center mb-4 border-b border-b-gray-100 gap-4">
                <h3 class="text-lg font-semibold">Filters</h3>
                <button onclick="toggleFilter()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Add your filter content here -->
            <div class="space-y-4">
                <div class="border-b border-b-gray-100 py-4">
                    <x-input-label for="period" :value="__('Period')" />
                    <x-text-input id="period" class="block mt-1 w-full" type="date" name="period" :value="old('period')" required autofocus autocomplete="date" />
                    <x-input-error :messages="$errors->get('period')" class="mt-2" />
                </div>

                <div class="border-b border-b-gray-100 py-4 flex-col flex gap-4">
                    <p class="text-md text-gray-500 font-semibold">Task Group</p>
                    <label for="design" class="inline-flex items-center space-x-2">
                        <x-checkbox id="design" name="task_group" :value="old('task_group')" />
                        <span>Design</span>
                    </label>

                    <label for="development" class="inline-flex items-center space-x-2">
                        <x-checkbox id="development" name="task_group" :value="old('task_group')" />
                        <span>Development</span>
                    </label>

                    <label for="testing" class="inline-flex items-center space-x-2">
                        <x-checkbox id="testing" name="task_group" :value="old('task_group')" />
                        <span>Testing</span>
                    </label>

                    <label for="marketing" class="inline-flex items-center space-x-2">
                        <x-checkbox id="marketing" name="task_group" :value="old('task_group')" />
                        <span>Marketing</span>
                    </label>

                    <label for="project_management" class="inline-flex items-center space-x-2">
                        <x-checkbox id="project_management" name="task_group" :value="old('task_group')" />
                        <span>Project Management</span>
                    </label>
                </div>

                <div class="border-b border-b-gray-100 py-4 flex-col flex gap-4">
                    <p class="text-md text-gray-500 font-semibold">Reporter</p>

                    <label for="oscar_holloway" class="inline-flex items-center space-x-2">
                        <x-checkbox id="oscar_holloway" name="reporter" :value="old('reporter')" />
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                        <span>Oscar Holloway</span>
                    </label>

                    <label for="leonard_rodriguez" class="inline-flex items-center space-x-2">
                        <x-checkbox id="leonard_rodriguez" name="reporter" :value="old('reporter')" />
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                        <span>Leonard Rodriguez</span>
                    </label>

                    <label for="owen_chambers" class="inline-flex items-center space-x-2">
                        <x-checkbox id="owen_chambers" name="reporter" :value="old('reporter')" />
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                        <span>Owen Chambers</span>
                    </label>

                    <label for="gabriel_flowers" class="inline-flex items-center space-x-2">
                        <x-checkbox id="gabriel_flowers" name="reporter" :value="old('reporter')" />
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                        <span>Gabriel Flowers</span>
                    </label>

                    <label for="violet_robbins" class="inline-flex items-center space-x-2">
                        <x-checkbox id="violet_robbins" name="reporter" :value="old('reporter')" />
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                        <span>Violet Robbins</span>
                    </label>

                    <p class="text-md text-blue-400 underline font-semibold">View more <i class="fas fa-angle-down px-1"></i></p>
                </div>

                <div class="border-b border-b-gray-100 py-4">
                    <p class="text-md text-gray-500 font-semibold">Assignees</p>
                    <x-text-input id="assignees" class="block mt-1 w-full" type="text" name="assignees" :value="old('assignees')" required autofocus autocomplete="assignees" />

                    <div class="grid grid-cols-2 gap-4 py-2">
                        <div class="bg-gray-100 rounded-full p-1 text-sm flex items-center justify-center gap-2">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                            <span>Violet Robbins</span>
                            <i class="fas fa-times-circle"></i>
                        </div>

                        <div class="bg-gray-100 rounded-full p-1 text-sm flex items-center justify-center gap-2">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                            <span>Ronald Robbins</span>
                            <i class="fas fa-times-circle"></i>
                        </div>

                        <div class="bg-gray-100 rounded-full p-1 text-sm flex items-center justify-center gap-2">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                            <span>Birdie Garner</span>
                            <i class="fas fa-times-circle"></i>
                        </div>

                        <div class="bg-gray-100 rounded-full p-1 text-sm flex items-center justify-center gap-2">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ rand(1, 1000) }}" class="rounded-full h-6 w-6 object-contain">
                            <span>Marvin Cooper</span>
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="py-2">
                    <x-input-label for="estimate" :value="__('Estimate')" />
                    <x-text-input id="estimate" class="block mt-1 w-full" type="text" name="estimate" :value="old('estimate')" required autofocus autocomplete="assignees" />
                    <x-input-error :messages="$errors->get('assignees')" class="mt-2" />
                </div>

                <div class="py-2">
                    <x-input-label for="priority" :value="__('Priority')" />
                    <x-text-input id="priority" class="block mt-1 w-full" type="text" name="priority" :value="old('priority')" required autofocus autocomplete="assignees" />
                    <x-input-error :messages="$errors->get('assignees')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between pt-6">
                <div class="flex items-center justify-center text-sm">
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
            color: white !important;
        }

        .dark .active {
            background-color: #60a5fa; 
            color: black !important;
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
 
        #timeline {
            position: relative; /* or just let it inherit default */
        }
 
        #timeline .day-grid {
            min-width: calc(40px * {{ $daysInMonth }});
            overflow-x: auto;
            display: grid;
            grid-template-columns: repeat({{ $daysInMonth }}, 40px);
            gap: 8px;
        }
    </style>

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
            $('#' + viewId).css('display', 'block');
            $('#' + viewId).show();
        }

        const tasks = @json($tasks);

        // Show the list view by default when the page loads using jQuery's ready function
        $(document).ready(function() {
            showView('timeline');
            window.toggleFilter = toggleFilter;
            initializeTaskDays();

            if (typeof tasks !== 'undefined') {
                const placeholderHTML = '<div class="drop-placeholder h-20 border-2 border-dashed border-gray-300 rounded-xl my-2"></div>';

                $('.task-column').each(function() {
                    new Sortable(this, {
                        group: 'shared',
                        animation: 150,
                        ghostClass: 'bg-blue-100',

                        onStart: function(evt) {
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
                    const $row = $(`div[data-task="${task.id}"]`);
                    const $cells = $(`label[data-task="${task.id}"]`);
                    for (let i = 0; i < task.duration; i++) {
                        $cells.eq(task.start - 1 + i).remove();
                    }
                    const $taskBlock = $(`<div class="bg-blue-500 col-span-${task.duration} rounded text-xs text-white text-center flex items-center justify-center" style="grid-column: span ${task.duration};">`).text(task.name);
                    $cells.eq(task.start - 1).before($taskBlock);
                });
            } else {
                console.warn('tasks is not defined');
            }
        });

        function initializeTaskDays() {
            $('.task-day').each(function() {
                const $this = $(this);
                const taskName = $this.data('task');
                const day = parseInt($this.data('day'));
                updateTaskDayStyle($this, isTaskActive(taskName, day));
                if (isTaskActive(taskName, day)) {
                    $this.removeClass('bg-blue-50 text-blue-100').addClass('bg-blue-500 text-white active');
                }
            });
        }

        function updateTaskDayStyle($element, isActive) {
            if (isActive) {
                $element.addClass('active bg-blue-500 text-white').removeClass('bg-blue-50 text-blue-100');
            } else {
                $element.removeClass('active bg-blue-500 text-white').addClass('bg-blue-50 text-blue-100');
            }
        }

        function isTaskActive(taskName, day) {
            const task = tasks.find(t => t.name === taskName);
            if (!task) return false;
            return day >= task.start && day < (task.start + task.duration);
        }
    </script>
</x-app-layout>