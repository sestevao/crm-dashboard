<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="registrationForm" class="w-full mx-auto">
        @csrf

        @include('auth.partials.step1')
        @include('auth.partials.step2')
        @include('auth.partials.step3')
        @include('auth.partials.step4')

        <div class="flex items-center justify-between mt-4">
            <x-secondary-button type="button" id="prevStepBtn" class=""> {{ __('Previuos') }} </x-secondary-button>

            <x-link href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </x-link>

            <x-primary-button type="button" id="nextStepBtn" class=""> {{ __('Next') }} </x-primary-button>
        </div>
    </form>

    @push('scripts')
    <script>
        const steps = ['step1', 'step2', 'step3', 'step4'];

        function getCurrentStepIndex() {
            const current = $('.step-content:not(.hidden)').attr('id');
            return steps.indexOf(current);
        }

        function validateStep(stepId) {
            let valid = true;
            $('#' + stepId).find('input, select, textarea').each(function() {
                if (!this.checkValidity()) {
                    this.reportValidity();
                    valid = false;
                    return false; // break loop
                }
            });
            return valid;
        }

        $('#nextStepBtn').on('click', function() {
            let currentIndex = getCurrentStepIndex();
            if (currentIndex === -1) return;

            if (!validateStep(steps[currentIndex])) return;

            if (currentIndex < steps.length - 1) {
                $('#' + steps[currentIndex]).addClass('hidden');
                $('#' + steps[currentIndex + 1]).removeClass('hidden');

                if (steps[currentIndex + 1] === 'step4') {
                    $(this).text('Register');
                }
            } else {
                $('#registrationForm').submit();
            }
        });

        $('#prevStepBtn').on('click', function() {
            let currentIndex = getCurrentStepIndex();
            if (currentIndex > 0) {
                $('#' + steps[currentIndex]).addClass('hidden');
                $('#' + steps[currentIndex - 1]).removeClass('hidden');
                $('#nextStepBtn').text('Next');
            }
        });
    </script>
    @endpush
</x-guest-layout>