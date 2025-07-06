
    <div class="relative w-6 h-6">
        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
            <!-- Background circle -->
            <path 
                class="text-gray-200" 
                stroke="currentColor" 
                stroke-width="4" 
                fill="none" 
                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
            />
            <!-- Progress circle -->
            <path 
                class="text-{{ $color }}-500" 
                stroke="currentColor" 
                stroke-width="4" 
                stroke-dasharray="{{ $progress }}, 100" 
                fill="none" 
                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" 
            />
        </svg>
    </div>

