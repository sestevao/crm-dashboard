<!-- Step 1: Valid your Phone -->
<div id="step1" class="step-content">
    <div class="text-center gap-2 py-4">
        <h3 class="pt-6 font-medium text-xl text-blue-500 dark:text-blue-400">STEP 1/4</h3>
        <h3 class="pb-6 font-medium text-2xl">Validate your Phone</h3>
    </div>

    <!-- Phone Number -->
    <div class="mb-4">
        <x-input-label for="phone" :value="__('Phone Number')" />
        <div class="flex gap-2">
            <select name="country_code" id="country_code" class="rounded-md text-center shadow-sm border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option value="+44">+44</option>
                <option value="+1">+1</option>
                <option value="+91">+91</option>
                <option value="+61">+61</option>
                <option value="+86">+86</option>
            </select>
            <x-text-input id="phone_number" class="block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" type="tel" name="phone_number" :value="old('phone_number')" required placeholder="Enter phone number" pattern="[0-9]{9,10}" title="Please enter a valid phone number" />
        </div>
        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Enter your phone number without country code (e.g., 1234567890)</p>
    </div>

    <!-- Verification Code -->
    <div class="mt-4">
        <div class="flex justify-between items-center">
            <x-input-label for="verification_code" :value="__('Code from SMS')" />
            <button type="button" id="sendCodeBtn" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-600 focus:outline-none" onclick="sendVerificationCode()">
                Send Code
            </button>
        </div>
        <div class="flex gap-2 mt-1 justify-start items-center">
            @for ($i = 0; $i
            < 6; $i++)
                <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" oninput="moveToNext(this, {{ $i + 1 }})" onkeydown="handleBackspace(this, event)" />
            @endfor
        </div>
        <input type="hidden" id="verification_code" name="verification_code" required />
        <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
    </div>

    <div class="flex items-center justify-center rounded-lg my-6 bg-blue-50 dark:bg-blue-900 p-6 text-blue-500 dark:text-blue-300" id="smsNotification" style="display:none;">
        <i class="fas fa-info-circle text-blue-500 dark:text-blue-300 mr-2"></i>
        <span>
            SMS was sent to your number <span id="displayPhoneNumber"></span>
            It will be valid for 01:25
        </span>
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <div class="relative">
            <x-text-input id="password" class="block mt-1 w-full pr-10 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" type="password" name="password" required autocomplete="new-password" />
            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1" onclick="togglePasswordVisibility('password')">
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-300" id="password-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <div class="relative">
            <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100" type="password" name="password_confirmation" required autocomplete="new-password" />
            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1" onclick="togglePasswordVisibility('password_confirmation')">
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-300" id="password_confirmation-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
</div>

@push('scripts')
<script>
    function sendVerificationCode() {
        const countryCode = $('#country_code').val();
        const phoneNumber = $('#phone_number').val();
        const phoneRegex = /^[0-9]{9,10}$/;

        if (!phoneRegex.test(phoneNumber)) {
            alert('Please enter a valid phone number first');
            return;
        }

        // Format the phone number with spaces
        const formattedNumber = countryCode + ' ' + phoneNumber.replace(/(\d{3})(?=(\d{3})+(?!\d))/g, '$1 ');
        $('#displayPhoneNumber').text(formattedNumber);
        $('#smsNotification').fadeIn();

        const $sendCodeBtn = $('#sendCodeBtn');
        const originalText = $sendCodeBtn.text();

        $sendCodeBtn.prop('disabled', true).text('Sending...');

        // Simulate API call with timeout
        setTimeout(() => {
            $sendCodeBtn.text('Code Sent');
            let timeLeft = 60;
            const timer = setInterval(() => {
                timeLeft--;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    $sendCodeBtn.prop('disabled', false).text(originalText);
                } else {
                    $sendCodeBtn.text(`Resend in ${timeLeft}s`);
                }
            }, 1000);
        }, 1000);
    }

    function moveToNext(field, position) {
        field.value = field.value.replace(/[^0-9]/g, '');
        if (field.value && position < 6) {
            field.nextElementSibling.focus();
        }
        combineValues();
    }

    function handleBackspace(field, event) {
        if (event.key === 'Backspace' && !field.value) {
            const prev = field.previousElementSibling;
            if (prev) {
                prev.focus();
                event.preventDefault();
            }
        }
    }

    function combineValues() {
        const inputs = document.querySelectorAll('.w-12');
        let code = '';
        inputs.forEach(input => code += input.value || ''); // Add empty string if value is undefined
        document.getElementById('verification_code').value = code;
        console.log(code);
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(inputId + '-eye');

        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
        } else {
            input.type = 'password';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
        }
    }
</script>
@endpush