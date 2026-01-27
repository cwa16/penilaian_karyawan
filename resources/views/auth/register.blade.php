<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required autofocus autocomplete="nik" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Status -->
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <x-text-input id="status" class="block mt-1 w-full" type="text" name="status" :value="old('status')" required autofocus autocomplete="status" />
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Department -->
        <div class="mt-4">
            <x-input-label for="dept" :value="__('Department')" />
            <x-text-input id="dept" class="block mt-1 w-full" type="text" name="dept" :value="old('dept')" required autofocus autocomplete="dept" />
            <x-input-error :messages="$errors->get('dept')" class="mt-2" />
        </div>

        <!-- Position -->
        <div class="mt-4">
            <x-input-label for="jabatan" :value="__('Position')" />
            <x-text-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required autofocus autocomplete="jabatan" />
            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
        </div>

        <!-- Education -->
        <div class="mt-4">
            <x-input-label for="pendidikan" :value="__('Education')" />
            <x-text-input id="pendidikan" class="block mt-1 w-full" type="text" name="pendidikan" :value="old('pendidikan')" required autofocus autocomplete="pendidikan" />
            <x-input-error :messages="$errors->get('pendidikan')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
