<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- User Type -->
        <div class="mt-4">
            <x-input-label :value="__('User Type')" />
            <input type="radio" name="user_type" value="client" id="client" class="mr-2" {{ old('user_type') === 'client' ? 'checked' : '' }}>
            <label for="client" class="mr-4">Client</label>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
            <input type="radio" name="user_type" value="freelancer" id="freelancer" class="mr-2" {{ old('user_type') === 'freelancer' ? 'checked' : '' }}>
            <label for="freelancer">Freelancer</label>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <!-- Client Fields -->
        <div id="client-fields" class="mt-4 hidden">
            <x-input-label for="client_location" :value="__('Location')" />
            <x-text-input id="client_location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />

            <x-input-label for="client_language" :value="__('Language')" />
            <x-text-input id="client_language" class="block mt-1 w-full" type="text" name="language" :value="old('language')" />
            <x-input-error :messages="$errors->get('language')" class="mt-2" />
        </div>

        <!-- Freelancer Fields -->
        <div id="freelancer-fields" class="mt-4 hidden">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />

            <x-input-label for="skills" :value="__('Skills')" />
            <x-text-input id="skills" class="block mt-1 w-full" type="text" name="skills" :value="old('skills')" />
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />

            <x-input-label for="freelancer_location" :value="__('Location')" />
            <x-text-input id="freelancer_location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />

            <x-input-label for="freelancer_language" :value="__('Language')" />
            <x-text-input id="freelancer_language" class="block mt-1 w-full" type="text" name="language" :value="old('language')" />
            <x-input-error :messages="$errors->get('language')" class="mt-2" />

            <x-input-label for="experience" :value="__('Experience')" />
            <x-text-input id="experience" class="block mt-1 w-full" type="text" name="experience" :value="old('experience')" />
            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const clientRadio = document.getElementById('client');
                const freelancerRadio = document.getElementById('freelancer');
                const clientFields = document.getElementById('client-fields');
                const freelancerFields = document.getElementById('freelancer-fields');

                function toggleFields() {
                    if (clientRadio.checked) {
                        clientFields.classList.remove('hidden');
                        freelancerFields.classList.add('hidden');
                    } else if (freelancerRadio.checked) {
                        freelancerFields.classList.remove('hidden');
                        clientFields.classList.add('hidden');
                    } else {
                        freelancerFields.classList.add('hidden');
                        clientFields.classList.add('hidden');
                    }
                }

                clientRadio.addEventListener('change', toggleFields);
                freelancerRadio.addEventListener('change', toggleFields);

                // Run on page load for "old" input
                toggleFields();
            });
        </script>
    </form>
</x-guest-layout>
