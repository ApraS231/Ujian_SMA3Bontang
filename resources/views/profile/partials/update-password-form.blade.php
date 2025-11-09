<section>
    <header>
        <h2 class="text-lg font-medium text-base-content">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-base-content text-opacity-60">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-control">
            <label class="label" for="update_password_current_password">
                <span class="label-text">{{ __('Kata Sandi Saat Ini') }}</span>
            </label>
            <input id="update_password_current_password" name="current_password" type="password" class="input input-bordered w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-control">
            <label class="label" for="update_password_password">
                <span class="label-text">{{ __('Kata Sandi Baru') }}</span>
            </label>
            <input id="update_password_password" name="password" type="password" class="input input-bordered w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-control">
            <label class="label" for="update_password_password_confirmation">
                <span class="label-text">{{ __('Konfirmasi Kata Sandi') }}</span>
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input input-bordered w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-base-content text-opacity-60"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
