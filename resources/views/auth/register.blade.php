<x-guest-layout>
    <form method="POST" action="{{ route('register') }}"  id="registrationForm"  class="w-full mx-auto">
        @csrf

        <div id="step1" class="step-content hidden">
            <div class="text-center gap-2 py-4">
                <h3 class="pt-6 font-medium text-xl text-blue-500 ">STEP 1/4</h3>
                <h3 class="pb-6 font-medium text-2xl">Valid your Phone</h3>
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <x-input-label for="phone" :value="__('Phone Number')" />
                <div class="flex gap-2">
                    <select name="country_code" id="country_code" class="rounded-md text-center shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="+44">+44</option>
                        <option value="+1">+1</option>
                        <option value="+91">+91</option>
                        <option value="+61">+61</option>
                        <option value="+86">+86</option>
                    </select>
                    <x-text-input  id="phone_number"  class="block w-full"  type="tel"  name="phone_number"  :value="old('phone_number')"  required  placeholder="Enter phone number" pattern="[0-9]{9,10}" title="Please enter a valid phone number" />
                </div>
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                <p class="text-sm text-gray-500 mt-1">Enter your phone number without country code (e.g., 1234567890)</p>
            </div>

            <!-- Verification Code -->
            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <x-input-label for="verification_code" :value="__('Code from SMS')" />
                    <button  type="button"  id="sendCodeBtn" class="text-sm text-blue-600 hover:text-blue-800 focus:outline-none" onclick="sendVerificationCode()" >
                        Send Code
                    </button>
                </div>
                <div class="flex gap-2 mt-1 justify-start items-center">
                    <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl" oninput="moveToNext(this, 1)" onkeydown="handleBackspace(this, event)" />
                    <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl" oninput="moveToNext(this, 2)" onkeydown="handleBackspace(this, event)" />
                    <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl" oninput="moveToNext(this, 3)" onkeydown="handleBackspace(this, event)" />
                    <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl" oninput="moveToNext(this, 4)" onkeydown="handleBackspace(this, event)" />
                    <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl" oninput="moveToNext(this, 5)" onkeydown="handleBackspace(this, event)" />
                    <x-text-input type="text" maxlength="1" class="w-12 h-12 text-center text-xl" oninput="moveToNext(this, 6)" onkeydown="handleBackspace(this, event)" />
                </div>
                <input type="hidden" id="verification_code" name="verification_code" required />
                <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center rounded-lg my-6 bg-blue-50 p-6 text-blue-500" id="smsNotification">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                <span class="">
                    SMS was sent to your number <span id="displayPhoneNumber"></span>
                    It will be valid for 01:25
                </span>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="new-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1"onclick="togglePasswordVisibility('password')">
                        <svg class="h-5 w-5 text-gray-500" id="password-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                    <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1"onclick="togglePasswordVisibility('password_confirmation')">
                        <svg class="h-5 w-5 text-gray-500" id="password-confirmation-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
            
        <div id="step2" class="step-content">
            <div class="text-center gap-2 py-4">
                <h3 class="pt-6 font-medium text-xl text-blue-500 ">STEP 2/4</h3>
                <h3 class="pb-6 font-medium text-2xl">Tell me about yourself</h3>
            </div>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <div id="step3" class="step-content hidden">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <div id="step4" class="step-content hidden">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button type="button" id="nextStepBtn" class="ms-4"> {{ __('Next Step') }} </x-primary-button>
            <!-- <x-primary-button class="ms-4"> {{ __('Register') }} </x-primary-button> -->
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        $('#nextStepBtn').on('click', function () {
            const phoneInput = $('#phone_number').val();
            const verificationInput = $('#verification_code').val();
            const phoneRegex = /^[0-9]{9,10}$/;
            const codeRegex = /^[0-9]{6}$/;

            // if (!phoneRegex.test(phoneInput)) {
            //     alert('Please enter a valid phone number');
            //     return;
            // }

            // if (!codeRegex.test(verificationInput)) {
            //     alert('Please enter a valid verification code');
            //     return;
            // }

            // Hide Step 1
            $('#step1').addClass('hidden');
            // Show Step 2
            $('#step2').removeClass('hidden');
            
            // Change button to submit
            $(this).text('Register').attr('type', 'submit');
            $('.mb-4, .mt-4').not('#nextStepFields').addClass('hidden');
            $('#smsNotification').addClass('hidden');
            
            $('#nextStepFields').removeClass('hidden');
            
            $(this).text('Register').attr('type', 'submit');
        });

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
</x-guest-layout>
