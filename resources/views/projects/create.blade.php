<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <h2 class="text-4xl font-semibold text-gray-800 dark:text-gray-200 leading-tight py-10">
                {{ __('Add Project') }}
            </h2>
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-4">
                        <div>
                            <x-input-label for="code" :value="__('Project Code')" />
                            <x-text-input type="text" name="code" id="code" class="mt-1 block w-full text-gray-700 font-bold" readonly value="PN0001234" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Project Name')" />
                            <x-text-input type="text" name="name" id="name" class="mt-1 block w-full" />
                        </div>

                        <div class="flex items-center justify-center w-full gap-4">
                            <div class="w-full">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Starts</label>
                                <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="w-full">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dead Line</label>
                                <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                            <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <div class="p-4 border border-gray-200 rounded-lg w-[400px]">
                            <p class="text-lg font-bold">Select Image</p>
                            <p class="text-gray-700 text-sm">Select or upload an avatar for the project (available formats: jpg, png, gif, svg, webp)</p>

                            <div class="grid grid-cols-4 gap-4 p-4">
                                @foreach(range(1, 11) as $i)
                                    <div class="relative cursor-pointer hover:ring-2 hover:ring-blue-500 rounded-lg p-2" onclick="selectProjectImage('project{{ $i }}.png')">
                                        <img  src="{{ asset('images/project'.$i.'.png') }}"  alt="Project {{ $i }}"  class="w-12 h-12 rounded-lg" id="project{{ $i }}" >
                                        <div  class="absolute inset-0 bg-blue-500 bg-opacity-50 hidden rounded-lg check-overlay" id="check-project{{ $i }}" >
                                            <svg class="w-6 h-6 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="relative cursor-pointer hover:ring-2 hover:ring-blue-500 rounded-lg p-2" onclick="selectProjectImage('upload-image.png')" >
                                    <img src="{{ asset('images/upload-image.png') }}" alt="Upload Image" class="w-12 h-12 rounded-lg" id="upload-image" />
                                    <div class="absolute inset-0 bg-blue-500 bg-opacity-50 hidden rounded-lg check-overlay" id="check-upload-image" >
                                        <svg class="w-6 h-6 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="project_image" id="project_image">
                        </div>

                        <div class="flex items-start justify-start gap-4 px-4">
                            <div class="p-2 font-bold rounded-lg bg-purple-100 text-purple-600 cursor-pointer hover:bg-purple-200 transition-colors duration-200" onclick="document.getElementById('file_attachment').click()">
                                <i class="fas fa-paperclip p-2"></i>
                                <input type="file" id="file_attachment" name="attachments[]" class="hidden" multiple onchange="handleFileSelect(this)">
                            </div>
                            <div class="p-2 font-bold rounded-lg bg-blue-100 text-blue-400 cursor-pointer hover:bg-blue-200 transition-colors duration-200" onclick="addProjectLink()">
                                <i class="fas fa-link p-2"></i>
                            </div>

                            <div id="selected_files" class="flex flex-col gap-2"></div>
                            <div id="project_links" class="flex flex-col gap-2"></div>
                        </div>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('projects.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <x-primary-button type="submit"> Save Project </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectProjectImage(imageName) {
            document.querySelectorAll('.check-overlay').forEach(overlay => {
                overlay.classList.add('hidden');
            });

            const checkOverlay = document.getElementById('check-' + imageName.replace('.png', ''));
            checkOverlay.classList.remove('hidden');

            document.getElementById('project_image').value = imageName;
        }
        
        function handleFileSelect(input) {
            const filesContainer = document.getElementById('selected_files');
            filesContainer.innerHTML = '';
            
            Array.from(input.files).forEach(file => {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'flex items-center gap-2 p-2 bg-purple-50 rounded-lg';
                fileDiv.innerHTML = `
                    <i class="fas fa-file text-purple-600"></i>
                    <span class="text-sm">${file.name}</span>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                filesContainer.appendChild(fileDiv);
            });
        }

        function addProjectLink() {
            const url = prompt('Enter the project link URL:');
            if (!url) return;

            const linksContainer = document.getElementById('project_links');
            const linkDiv = document.createElement('div');
            linkDiv.className = 'flex items-center gap-2 p-2 bg-blue-50 rounded-lg';
            linkDiv.innerHTML = `
                <i class="fas fa-link text-blue-400"></i>
                <a href="${url}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">${url}</a>
                <input type="hidden" name="project_links[]" value="${url}">
                <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            linksContainer.appendChild(linkDiv);
        }
    </script>
</x-app-layout>