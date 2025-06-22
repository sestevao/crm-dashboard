@props(['disabled' => false])

<input
    type="checkbox"
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge([
        'class' => 'rounded border-gray-300 text-indigo-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm dark:focus:ring-offset-gray-800'
    ]) }}>