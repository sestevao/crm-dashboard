<!-- Step 4: Invite Team Members -->
<div id="step4" class="step-content hidden">
    <div class="text-center gap-2 py-4">
        <h3 class="pt-6 font-medium text-xl text-blue-500 dark:text-blue-400">STEP 4/4</h3>
        <h3 class="pb-6 font-medium text-2xl">Invite Team Members</h3>
    </div>

    <div id="teamMembersContainer" class="space-y-4">
        <div class="team-member flex gap-2">
            <input type="email" name="team_members[]" placeholder="Member's email"
                class="block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                required />
            <button type="button" class="remove-member-btn px-3 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none">Remove</button>
        </div>
    </div>

    <button type="button" id="addMemberBtn"
        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
        Add another member
    </button>
</div>

@push('scripts')
<script>
    // Add/remove team members logic
    $('#addMemberBtn').on('click', function() {
        const newMember = `
                <div class="team-member flex gap-2">
                    <input type="email" name="team_members[]" placeholder="Member's email"
                        class="block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 p-2 focus:border-indigo-500 focus:ring-indigo-500"
                        required />
                    <button type="button" class="remove-member-btn px-3 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none">Remove</button>
                </div>`;
        $('#teamMembersContainer').append(newMember);
    });

    $(document).on('click', '.remove-member-btn', function() {
        $(this).closest('.team-member').remove();
    });
</script>
@endpush