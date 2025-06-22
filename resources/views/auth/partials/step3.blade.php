<!-- Step 3: Tell me about your company -->
<div id="step3" class="step-content hidden">
    <div class="text-center gap-2 py-4">
        <h3 class="pt-6 font-medium text-xl text-blue-500 dark:text-blue-400">STEP 3/4</h3>
        <h3 class="pb-6 font-medium text-2xl">Tell me about your company</h3>
    </div>

    <!-- Your Company’s Name -->
    <div class="mb-4">
        <x-input-label for="company_name" :value="__('Your Company’s Name')" />
        <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required />
        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
    </div>

    <!-- Business Direction -->
    <div class="mb-4">
        <x-input-label for="business_direction" :value="__('Business Direction')" />
        <select id="business_direction" name="business_direction" required
            class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="" disabled selected>Select your business direction</option>
            <option value="technology">Technology</option>
            <option value="marketing">Marketing</option>
            <option value="finance">Finance</option>
            <option value="education">Education</option>
            <option value="healthcare">Healthcare</option>
            <option value="other">Other</option>
        </select>
        <x-input-error :messages="$errors->get('business_direction')" class="mt-2" />
    </div>

    <!-- How many people in your company? -->
    <div class="mb-4">
        <x-input-label :value="__('How many people in your company?')" />
        <div class="flex flex-wrap gap-2 mt-2">
            @php
            $sizes = ['Only me', '2-5', '6-10', '11-20', '21-40', '41-50', '51-100', '101-500'];
            @endphp
            @foreach ($sizes as $size)
            <button type="button"
                class="people-size-btn px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 hover:bg-indigo-500 hover:text-white focus:outline-none"
                data-value="{{ $size }}">
                {{ $size }}
            </button>
            @endforeach
        </div>
        <input type="hidden" id="company_size" name="company_size" required />
        <x-input-error :messages="$errors->get('company_size')" class="mt-2" />
    </div>
</div>

@push('scripts')
<script>
    // Company size selection buttons
    $('.people-size-btn').on('click', function() {
        $('.people-size-btn').removeClass('bg-indigo-500 text-white');
        $(this).addClass('bg-indigo-500 text-white');
        $('#company_size').val($(this).data('value'));
    });
</script>
@endpush