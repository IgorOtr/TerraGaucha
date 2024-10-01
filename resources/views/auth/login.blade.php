<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href=".">
                    <img width="180" src="{{ asset('assets/img/logo terra final-11.svg') }}" alt="">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                                autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                
                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" />
                
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3 btn btn-primary" style="background-color: #99262d !important;">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
