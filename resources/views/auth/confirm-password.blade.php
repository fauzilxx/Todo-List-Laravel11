<x-guest-layout>
    <div class="panel" style="max-width: 400px; margin: 0 auto; width: 100%;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon"
                style="margin: 0 auto 1rem; width: 80px; height: 80px; background: #fff; box-shadow: var(--shadow-md);">
                <img src="{{ asset('images/icon-todo.png') }}" alt="logo" style="width: 50px; height: 50px;">
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900);">Konfirmasi Password</h2>
            <p style="color: var(--gray-500); margin-top: 0.5rem;">Masukkan password untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="form-group" x-data="{ show: false }">
                <label for="password" class="form-label">Password</label>
                <div style="position: relative;">
                    <input id="password" class="form-input" :type="show ? 'text' : 'password'" name="password" required
                        autocomplete="current-password" placeholder="Masukkan password">
                    <button type="button" @click="show = !show"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                        <span class="material-symbols-outlined" x-show="!show" style="font-size: 20px;">visibility</span>
                        <span class="material-symbols-outlined" x-show="show" style="display: none; font-size: 20px;">visibility_off</span>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="form-hint" style="color: var(--danger-color);" />
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
                Konfirmasi
            </button>
        </form>
    </div>
</x-guest-layout>
