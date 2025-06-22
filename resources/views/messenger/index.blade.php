<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('dashboard') }}" class="flex items-start justify-start text-blue-400 font-bold gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                Back to dashboard
            </a>

            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Messenger') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-8">
    </div>
</x-app-layout>