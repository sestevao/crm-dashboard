<button
    id="darkModeToggle"
    type="button"
    aria-label="Toggle Dark Mode"
    class="fixed top-14 right-14 flex items-center w-16 h-8 bg-gray-300 dark:bg-gray-700 rounded-full p-1 shadow-md transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
    <!-- Sun icon -->
    <svg
        class="w-5 h-5 text-yellow-400 mr-auto"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M10 15a5 5 0 100-10 5 5 0 000 10z" />
        <path
            fill-rule="evenodd"
            d="M10 1a1 1 0 011 1v1a1 1 0 11-2 0V2a1 1 0 011-1zm4.22 2.03a1 1 0 011.415 1.415l-.708.707a1 1 0 11-1.415-1.415l.708-.707zm4.78 6.97a1 1 0 110 2h-1a1 1 0 110-2h1zm-3.03 4.22a1 1 0 01-1.415 1.415l-.707-.708a1 1 0 111.415-1.414l.707.707zM10 17a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-2.03a1 1 0 01-1.415-1.415l.707-.707a1 1 0 111.414 1.415l-.707.707zm-4.78-6.97a1 1 0 110-2h1a1 1 0 110 2H1zm3.03-4.22a1 1 0 011.415-1.415l.707.707a1 1 0 11-1.414 1.414l-.708-.707z"
            clip-rule="evenodd" />
    </svg>

    <!-- Toggle Circle -->
    <div
        id="toggleCircle"
        class="bg-white w-6 h-6 rounded-full shadow-md transform transition-transform duration-300 relative z-10"
        style="transform: translateX(0)"></div>

    <!-- Moon icon -->
    <svg
        class="w-5 h-5 text-gray-400 dark:text-gray-300 ml-auto"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M17.293 13.293a8 8 0 01-10.586-10.586 8.004 8.004 0 0010.586 10.586z" />
    </svg>
</button>

<script>
    (() => {
        const toggle = document.getElementById('darkModeToggle');
        const toggleCircle = document.getElementById('toggleCircle');

        function setPosition() {
            if (
                localStorage.theme === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                document.documentElement.classList.add('dark');
                toggleCircle.style.transform = 'translateX(22px)';
            } else {
                document.documentElement.classList.remove('dark');
                toggleCircle.style.transform = 'translateX(0)';
            }
        }

        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                toggleCircle.style.transform = 'translateX(0)';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                toggleCircle.style.transform = 'translateX(22px)';
            }
        }

        setPosition();
        toggle.addEventListener('click', toggleDarkMode);
    })();
</script>