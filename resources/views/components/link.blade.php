<a href="{{ $href }}"
    {{ $attributes->merge([
       'class' => 'inline-flex items-center text-sm font-medium underline text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 rounded-md transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800'
   ]) }}>
    {{ $slot }}
</a>