<!-- Step 2: Tell me about yourself -->
<div id="step2" class="step-content hidden">
    <div class="text-center gap-2 py-4">
        <h3 class="pt-6 font-medium text-xl text-blue-500 dark:text-blue-400">STEP 2/4</h3>
        <h3 class="pb-6 font-medium text-2xl">Tell me about yourself</h3>
    </div>

    <!-- Why will you use the service? -->
    <div class="mb-4">
        <x-input-label for="service_use_reason" :value="__('Why will you use the service?')" />
        <select id="service_use_reason" name="service_use_reason" required
            class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="" disabled selected>Select an option</option>
            <option value="personal">Personal Productivity</option>
            <option value="team_collaboration">Team Collaboration</option>
            <option value="project_management">Project Management</option>
            <option value="freelance">Freelance Work</option>
            <option value="other">Other</option>
        </select>
        <x-input-error :messages="$errors->get('service_use_reason')" class="mt-2" />
    </div>

    <!-- What describes you best? (select) -->
    <div class="mb-4">
        <x-input-label for="user_description" :value="__('What describes you best?')" />
        <select id="user_description" name="user_description" required
            class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="" disabled selected>Select an option</option>
            <option value="developer">Developer</option>
            <option value="designer">Designer</option>
            <option value="manager">Manager</option>
            <option value="entrepreneur">Entrepreneur</option>
            <option value="student">Student</option>
            <option value="other">Other</option>
        </select>
        <x-input-error :messages="$errors->get('user_description')" class="mt-2" />
    </div>

    <!-- What describes you best? (textarea) -->
    <div class="mb-4">
        <x-input-label for="user_description_details" :value="__('Tell us more about yourself')" />
        <textarea id="user_description_details" name="user_description_details" rows="4" required
            class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Describe your background, interests, or goals...">{{ old('user_description_details') }}</textarea>
        <x-input-error :messages="$errors->get('user_description_details')" class="mt-2" />
    </div>
</div>