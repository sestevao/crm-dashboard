<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('projects.show', 1) }}" class="text-blue-400 hover:text-blue-500">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Research
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <x-secondary-button>
                    <i class="fas fa-edit mr-2"></i>
                    Edit Task
                </x-secondary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="col-span-2 space-y-6">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">Think over UX for Login and Registration, create a flow using wireframes. Upon completion, show the team and discuss. Attach the source to the task.</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Time Tracking</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Estimate</p>
                                <p class="text-gray-900 dark:text-gray-100">2h</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Time Spent</p>
                                <p class="text-gray-900 dark:text-gray-100">3h</p>
                            </div>
                        </div>
                        <div class="mt-4 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-blue-500 rounded-full" style="width: 40%"></div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Attachments</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-file text-gray-400"></i>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Attachmentname</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task Info Sidebar -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Status</h3>
                        <div class="bg-green-50 text-green-700 rounded-lg px-3 py-1 text-sm font-medium inline-block">
                            Done
                        </div>
                        <div class="bg-blue-50 text-blue-700 rounded-lg px-3 py-1 text-sm font-medium inline-block">
                            In progress
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Priority</h3>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-arrow-up text-red-500"></i>
                            <span class="font-medium">High</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Assignee</h3>
                        <div class="flex items-center gap-3">
                            <img src="" alt="" class="h-8 w-8 rounded-full">
                            <span class="text-gray-900 dark:text-gray-100">assignee</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Dates</h3>
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-500">Created</p>
                                <p class="text-gray-900 dark:text-gray-100">created_at</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Due Date</p>
                                <p class="text-gray-900 dark:text-gray-100">due_date</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>