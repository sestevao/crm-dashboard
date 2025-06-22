@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'block mt-1 w-full px-4 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-blue-200 dark:focus:ring-blue-600 focus:outline-none'
]) }}>