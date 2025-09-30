<div class="min-h-screen flex items-center justify-center bg-cover bg-center" 
     style="background-image: url('{{ asset('images/bnnk-kendal.jpg') }}')">
    
    <div class="bg-white bg-opacity-90 shadow-lg rounded-xl w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-center text-blue-800 mb-6 font-[Montserrat]">Login Admin</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit.prevent="login" class="space-y-4">
            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full"
                              type="email" name="email" required autofocus />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                              type="password" name="password" required />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remember" class="ml-2 text-sm text-gray-700">Ingat Saya</label>
            </div>

            <!-- Button -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Masuk') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
