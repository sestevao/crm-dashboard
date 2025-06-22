<nav class="bg-white dark:bg-gray-800 rounded-xl border-r border-gray-100 dark:border-gray-700 w-64 fixed h-[970px] m-6 p-4 flex flex-col justify-between">
    <div class="flex flex-col flex-1">
        <div class="shrink-0 flex items-start justify-start p-6 ">
            <a href="{{ route('dashboard') }}">
                <img id="logoLight" src="{{ asset('images/logo-white.svg') }}" alt="Logo" class="h-8 w-auto block dark:hidden">
                <img id="logoDark" src="{{ asset('images/logo-dark.svg') }}" alt="Logo" class="h-8 w-auto hidden dark:block">
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 flex flex-col space-y-1 py-4 gap-4">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-4 py-2 text-sm gap-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 13C9.65685 13 11 14.3431 11 16V18C11 19.6569 9.65685 21 8 21H6C4.34315 21 3 19.6569 3 18V16C3 14.3431 4.34315 13 6 13H8ZM18 13C19.6569 13 21 14.3431 21 16V18C21 19.6569 19.6569 21 18 21H16C14.3431 21 13 19.6569 13 18V16C13 14.3431 14.3431 13 16 13H18ZM8 3C9.65685 3 11 4.34315 11 6V8C11 9.65685 9.65685 11 8 11H6C4.34315 11 3 9.65685 3 8V6C3 4.34315 4.34315 3 6 3H8ZM18 3C19.6569 3 21 4.34315 21 6V8C21 9.65685 19.6569 11 18 11H16C14.3431 11 13 9.65685 13 8V6C13 4.34315 14.3431 3 16 3H18Z" fill="currentColor" />
                </svg>

                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')" class="block px-4 py-2 text-sm gap-2">
                <i class="fas fa-cubes"></i>
                {{ __('Projects') }}
            </x-nav-link>

            <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')" class="block px-4 py-2 text-sm gap-2">
                <i class="fas fa-calendar"></i>
                {{ __('Calendar') }}
            </x-nav-link>

            <x-nav-link :href="route('vacancies')" :active="request()->routeIs('vacancies')" class="block px-4 py-2 text-sm gap-2">
                <i class="fas fa-plane-up"></i>
                {{ __('Vacancies') }}
            </x-nav-link>

            <x-nav-link :href="route('employees')" :active="request()->routeIs('employees')" class="block px-4 py-2 text-sm gap-2">
                <i class="fas fa-users"></i>
                {{ __('Employees') }}
            </x-nav-link>

            <x-nav-link :href="route('messenger')" :active="request()->routeIs('messenger')" class="block px-4 py-2 text-sm gap-2">
                <i class="fas fa-comments"></i>
                {{ __('Messenger') }}
            </x-nav-link>

            <x-nav-link :href="route('info-portal')" :active="request()->routeIs('info-portal')" class="block px-4 py-2 text-sm gap-2">
                <i class="fas fa-folder"></i>
                {{ __('Info Portal') }}
            </x-nav-link>
        </div>
    </div>

    <!-- Bottom section: Support Team + Settings Dropdown -->
    <div class="flex flex-col gap-6">
        <!-- Support Team -->
        <div class="relative rounded-3xl p-2 flex flex-col gap-4 items-center overflow-hidden mb-4">
            <!-- Half-height background from bottom -->
            <div class="absolute bottom-0 left-0 w-full h-3/4 bg-[#F4F9FD] rounded-3xl z-0 dark:bg-[#1E293B]"></div>

            <div class="relative z-10">
                <img src="{{ asset('images/support-team.svg') }}" alt="Support Team" class="w-full h-auto" width="134" height="124">
            </div>

            <button id="supportButton" class="relative z-10 bg-blue-500 p-2 flex items-center justify-center rounded-lg text-white gap-2 shadow-sm dark:bg-blue-600">
                <i class="fa-regular fa-comment"></i>
                Support
            </button>
        </div>

        <!-- Support Modal -->
        <div id="supportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 dark:bg-gray-900 dark:bg-opacity-70 hidden overflow-y-auto h-full w-full z-[99999]">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Need some help?</h3>
                    <img src="{{ asset('images/support-modal.png') }}" alt="Support Team" class="w-full h-auto px-7" width="464" height="192">
                    <div class="mt-2 px-7 py-3 text-left">
                        <p class="text-sm text-gray-500 dark:text-gray-300">Describe your question and our specialists will answer you within 24 hours.</p>
                        <label for="request" class="text-gray-500 text-sm block mt-4">Request Subject</label>
                        <select id="request" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                            <option value="question">Question</option>
                            <option value="issue">Issue</option>
                            <option value="request">Request</option>
                        </select>
                        <label for="message" class="text-gray-500 text-sm block mt-4">Description</label>
                        <textarea id="message" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"></textarea>
                    </div>
                    <div class="flex justify-end gap-2 mt-4 px-4 py-3">
                        <x-secondary-button id="closeModal">Close</x-secondary-button>
                        <x-primary-button id="submitSupport">Send Request</x-primary-button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Settings Dropdown -->
        <div class="border-t border-gray-100 dark:border-gray-700 p-4">
            <div class="relative z-30">
                <button id="userDropdown" class="inline-flex items-center justify-between w-full px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-500 text-white text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>

                    <div class="ms-1"><i class="fa-solid fa-angle-down"></i></div>
                </button>

                <div id="dropdownContent" class="hidden absolute bottom-full left-0 w-48 py-1 mb-2 bg-white dark:bg-gray-800 rounded-md shadow-lg">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        {{ __('Profile') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    #darkModeToggle {
        cursor: pointer;
    }

    #darkModeToggle .dot {
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }
</style>

@push('scripts')
<script>
    $('#userDropdown').click(function(e) {
        e.stopPropagation();
        $('#dropdownContent').toggleClass('hidden');
    });

    $(document).click(function(e) {
        if (!$(e.target).closest('#dropdownContent').length) {
            $('#dropdownContent').addClass('hidden');
        }
    });

    // Support modal code
    $('#supportButton').click(function() {
        $('#supportModal').removeClass('hidden');
    });

    $('#closeModal').click(function() {
        $('#supportModal').addClass('hidden');
    });

    // Close modal when clicking outside
    $(window).click(function(e) {
        if ($(e.target).is('#supportModal')) {
            $('#supportModal').addClass('hidden');
        }
    });

    // Prevent modal from closing when clicking inside the modal content
    $('.modal-content').click(function(e) {
        e.stopPropagation();
    });

    // Submit support message
    $('#submitSupport').click(function() {
        // Add your support message submission logic here
        alert('Support message sent!');
        $('#supportModal').addClass('hidden');
    });
</script>
@endpush