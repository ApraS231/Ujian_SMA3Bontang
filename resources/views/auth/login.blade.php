<!-- File: resources/views/auth/login.blade.php -->
<x-guest-layout>
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="mb-4 text-center">
                <h2 class="card-title justify-center text-2xl font-bold">Login ke Sistem</h2>
                <p class="text-sm text-base-content text-opacity-60">Silakan masukkan email dan password Anda.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text">{{ __('Email') }}</span>
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="input input-bordered w-full" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-control">
                    <label class="label" for="password">
                        <span class="label-text">{{ __('Password') }}</span>
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="input input-bordered w-full" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="form-control">
                    <label for="remember_me" class="label cursor-pointer justify-start gap-2">
                        <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-primary" />
                        <span class="label-text">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <div class="card-actions justify-end items-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="link link-hover text-sm" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary ml-3">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
