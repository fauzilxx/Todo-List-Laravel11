<x-guest-layout>
    <div class="panel" style="max-width: 400px; margin: 0 auto; width: 100%;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon"
                style="margin: 0 auto 1rem; width: 80px; height: 80px; background: #fff; box-shadow: var(--shadow-md);">
                <img src="{{ asset('images/icon-todo.png') }}" alt="logo" style="width: 50px; height: 50px;">
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900);">Lupa Password</h2>
            <p style="color: var(--gray-500); margin-top: 0.5rem;">Masukkan email untuk reset password</p>
        </div>

        <x-auth-session-status class="alert alert-success" style="margin-bottom: 1.5rem;" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username" placeholder="Masukkan email anda">
                <x-input-error :messages="$errors->get('email')" class="form-hint" style="color: var(--danger-color);" />
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
                Kirim Link Reset Password
            </button>

            <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--gray-200);">
                <a href="{{ route('login') }}"
                    style="font-size: 0.875rem; color: var(--primary-color); text-decoration: none; font-weight: 600;">
                    ← Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
