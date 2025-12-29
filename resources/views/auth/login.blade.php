<x-guest-layout>
    <div class="panel" style="max-width: 400px; margin: 0 auto; width: 100%;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon"
                style="margin: 0 auto 1rem; width: 80px; height: 80px; background: #fff; box-shadow: var(--shadow-md);">
                <img src="{{ asset('images/icon-todo.png') }}" alt="logo" style="width: 50px; height: 50px;">
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900);">Selamat Datang</h2>
            <p style="color: var(--gray-500); margin-top: 0.5rem;">Silakan login untuk melanjutkan</p>
        </div>

        <x-auth-session-status class="alert alert-success" style="margin-bottom: 1.5rem;" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username" placeholder="Masukkan email anda">
                <x-input-error :messages="$errors->get('email')" class="form-hint"
                    style="color: var(--danger-color);" />
            </div>

            <!-- Password -->
            <div class="form-group" x-data="{ show: false }">
                <label for="password" class="form-label">Password</label>
                <div style="position: relative;">
                    <input id="password" class="form-input" :type="show ? 'text' : 'password'" name="password" required
                        autocomplete="current-password" placeholder="Masukkan password">
                    <button type="button" @click="show = !show"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                        <span class="material-symbols-outlined" x-show="!show"
                            style="font-size: 20px;">visibility</span>
                        <span class="material-symbols-outlined" x-show="show"
                            style="display: none; font-size: 20px;">visibility_off</span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="form-hint"
                    style="color: var(--danger-color);" />
            </div>

            <!-- Remember Me -->
            <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
                <label for="remember_me"
                    style="display: flex; align-items: center; cursor: pointer; gap: 0.5rem; color: var(--gray-600); font-size: 0.875rem;">
                    <input id="remember_me" type="checkbox" name="remember"
                        style="width: 16px; height: 16px; border-radius: 4px; border: 2px solid var(--gray-300);">
                    <span>Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        style="font-size: 0.875rem; color: var(--primary-color); text-decoration: none; font-weight: 500;">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
                Masuk Sekarang
            </button>

            <div
                style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--gray-200);">
                <span style="font-size: 0.875rem; color: var(--gray-600);">Belum punya akun?</span>
                <a href="{{ route('register') }}"
                    style="font-size: 0.875rem; color: var(--primary-color); text-decoration: none; font-weight: 600; margin-left: 0.25rem;">
                    Buat Akun Baru
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>