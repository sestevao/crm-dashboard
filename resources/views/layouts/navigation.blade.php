<nav class="bg-white dark:bg-gray-800 rounded-xl border-r border-gray-100 dark:border-gray-700 w-64 fixed h-[970px] m-6 p-4">
    <div class="h-full flex flex-col ">
        <div class="shrink-0 flex items-start justify-start p-6 ">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-white.svg') }}" alt="Logo" class="h-8 w-auto">
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 flex flex-col space-y-1 py-4 gap-4">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-4 py-2 text-sm gap-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 13C9.65685 13 11 14.3431 11 16V18C11 19.6569 9.65685 21 8 21H6C4.34315 21 3 19.6569 3 18V16C3 14.3431 4.34315 13 6 13H8ZM18 13C19.6569 13 21 14.3431 21 16V18C21 19.6569 19.6569 21 18 21H16C14.3431 21 13 19.6569 13 18V16C13 14.3431 14.3431 13 16 13H18ZM8 3C9.65685 3 11 4.34315 11 6V8C11 9.65685 9.65685 11 8 11H6C4.34315 11 3 9.65685 3 8V6C3 4.34315 4.34315 3 6 3H8ZM18 3C19.6569 3 21 4.34315 21 6V8C21 9.65685 19.6569 11 18 11H16C14.3431 11 13 9.65685 13 8V6C13 4.34315 14.3431 3 16 3H18Z" fill="currentColor"/>
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
                <i class="fas fa-portal"></i>
                {{ __('Info Portal') }}
            </x-nav-link>
        </div>

        <!-- Support Team -->
        <div class="relative rounded-3xl p-2 flex flex-col gap-4 items-center overflow-hidden mb-4">
            <!-- Half-height background from bottom -->
           <div class="absolute bottom-0 left-0 w-full h-3/4 bg-[#F4F9FD] rounded-3xl z-0"></div>

            <div class="relative z-10">
                <img src="{{ asset('images/support-team.svg') }}" alt="Support Team" class="w-full h-auto" width="134" height="124">
            </div>

            <button id="supportButton" class="relative z-10 bg-blue-500 p-2 flex items-center justify-center rounded-lg text-white gap-2 shadow-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1169 2.00003H12.6169C11.1421 1.99628 9.68472 2.34146 8.36607 3.00752C5.15179 4.61395 3.11832 7.90212 3.11693 11.4997L3.12322 11.8681C3.16381 12.9716 3.39941 14.0594 3.81816 15.0806L3.92393 15.3251L3.2286 17.0032C2.91564 17.7583 2.92435 18.6084 3.25269 19.3569L3.32817 19.5163C4.04434 20.9218 5.74201 21.5409 7.20512 20.8991L8.80293 20.1971L9.03643 20.2989C10.1711 20.7642 11.3884 21.0033 12.6195 21.0001C16.2149 20.9987 19.5031 18.9652 21.1114 15.7472C21.7756 14.4323 22.1208 12.9749 22.117 11.4976L22.117 11.0001C21.8542 6.21065 18.1382 2.41086 13.4391 2.02002L13.1169 2.00003ZM12.6144 4.00003L13.0749 3.99911L13.0618 3.99851C16.8687 4.20861 19.9084 7.24834 20.1185 11.0552L20.117 11.5001C20.12 12.6651 19.8484 13.8117 19.3243 14.8493C18.0527 17.3936 15.4568 18.999 12.6165 19.0001C11.452 19.0031 10.3053 18.7316 9.26778 18.2075C9.0013 18.0729 8.68862 18.0644 8.41522 18.1843L6.40171 19.0676C5.89594 19.2894 5.30609 19.0593 5.08423 18.5535C4.97478 18.304 4.97188 18.0206 5.0762 17.7689L5.94073 15.683C6.05229 15.4138 6.0409 15.1094 5.90952 14.8493C5.38547 13.8117 5.11389 12.6651 5.11692 11.5027C5.11802 8.66029 6.7234 6.06436 9.26398 4.79462C10.3053 4.26867 11.4519 3.99707 12.6144 4.00003Z" fill="white"/>
                </svg>
                Support
            </button>
        </div>

        <!-- Support Modal -->
        <div id="supportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-[999]">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Need some help?</h3>
                    
                    <img src="{{ asset('images/support-modal.png') }}" alt="Support Team" class="w-full h-auto px-7" width="464" height="192">

                    <div class="mt-2 px-7 py-3 text-left">
                        <p class="text-sm text-gray-500">Describe your question and our specialists will answer you within 24 hours.</p>

                        <div class="mt-4">
                        <label for="request" class="text-gray-500 text-sm text-left">Request Subject</label>
                        <select id="request" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none">
                            <option value="question">Question</option>
                            <option value="issue">Issue</option>
                            <option value="request">Request</option>
                        </select>
                        </div>

                        <div class="mt-4">
                        <label for="message" class="text-gray-500 text-sm text-left">Description</label>
                        <textarea id="message" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="submitSupport" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Send Request
                        </button>
                        <button id="closeModal" class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Close
                        </button>
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

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
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


<script>
$(document).ready(function() {
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

});
</script>
