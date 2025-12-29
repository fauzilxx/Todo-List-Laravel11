<x-guest-layout>
    <div class="panel" style="max-width: 400px; margin: 0 auto; width: 100%;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon"
                style="margin: 0 auto 1rem; width: 80px; height: 80px; background: #fff; box-shadow: var(--shadow-md);">
                <img src="{{ asset('images/icon-todo.png') }}" alt="logo" style="width: 50px; height: 50px;">
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900);">Buat Akun Baru</h2>
            <p style="color: var(--gray-500); margin-top: 0.5rem;">Mulai kelola tugasmu dengan mudah</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" placeholder="Masukkan nama lengkap">
                <x-input-error :messages="$errors->get('name')" class="form-hint" style="color: var(--danger-color);" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-input" type="email" name="email" :value="old('email')" required
                    autocomplete="username" placeholder="Masukkan email aktif">
                <x-input-error :messages="$errors->get('email')" class="form-hint"
                    style="color: var(--danger-color);" />
            </div>

            <!-- Password -->
            <div class="form-group" x-data="{ show: false }">
                <label for="password" class="form-label">Password</label>
                <div style="position: relative;">
                    <input id="password" class="form-input" :type="show ? 'text' : 'password'" name="password" required
                        autocomplete="new-password" placeholder="Buat password yang kuat">
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

            <!-- Confirm Password -->
            <div class="form-group" x-data="{ show: false }">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <div style="position: relative;">
                    <input id="password_confirmation" class="form-input" :type="show ? 'text' : 'password'"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Ulangi password di atas">
                    <button type="button" @click="show = !show"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                        <span class="material-symbols-outlined" x-show="!show"
                            style="font-size: 20px;">visibility</span>
                        <span class="material-symbols-outlined" x-show="show"
                            style="display: none; font-size: 20px;">visibility_off</span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="form-hint"
                    style="color: var(--danger-color);" />
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
                Daftar Sekarang
            </button>

            <div
                style="text-align: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--gray-200);">
                <span style="font-size: 0.875rem; color: var(--gray-600);">Sudah punya akun?</span>
                <a href="{{ route('login') }}"
                    style="font-size: 0.875rem; color: var(--primary-color); text-decoration: none; font-weight: 600; margin-left: 0.25rem;">
                    Masuk disini
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>