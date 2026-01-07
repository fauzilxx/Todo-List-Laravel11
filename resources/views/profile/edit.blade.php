<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - TaskFlow</title>
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">
    <link rel="icon" href="{{ asset('images/icon-todo.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="main-container">
        <header class="app-header">
            <div class="brand">
                <div class="brand-icon">
                    <img src="{{ asset('images/icon-todo.png') }}" alt="icon-todo">
                </div>
                <div class="brand-content">
                    <h1>Pengaturan Profil</h1>
                    <p class="brand-tagline">Kelola informasi akun Anda</p>
                </div>
            </div>
            <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
                <a href="/" class="btn" style="background: var(--gray-100); color: var(--gray-700); border: 2px solid var(--gray-200); text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back</span>
                    Kembali
                </a>
            </div>
        </header>

        @if(session('status') === 'profile-updated')
            <div class="alert alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                <span>Profil berhasil diperbarui!</span>
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="alert alert-success">
                <span class="material-symbols-outlined">check_circle</span>
                <span>Password berhasil diperbarui!</span>
            </div>
        @endif

        <div class="profile-grid" style="display: grid; grid-template-columns: 1fr; gap: var(--spacing-xl); max-width: 600px;">
            <!-- Panel Informasi Profil -->
            <div class="panel">
                <div class="panel-header">
                    <span class="material-symbols-outlined">person</span>
                    <h2 class="panel-title">Informasi Profil</h2>
                </div>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input id="name" name="name" type="text" class="form-input"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-input"
                            value="{{ old('email', $user->email) }}" required autocomplete="username"
                            placeholder="Masukkan email">
                        @error('email')
                            <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <span class="material-symbols-outlined" style="font-size: 20px;">save</span>
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- Panel Update Password -->
            <div class="panel">
                <div class="panel-header">
                    <span class="material-symbols-outlined">lock</span>
                    <h2 class="panel-title">Ubah Password</h2>
                </div>

                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group" x-data="{ show: false }">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <div style="position: relative;">
                            <input id="current_password" name="current_password" :type="show ? 'text' : 'password'"
                                class="form-input" autocomplete="current-password" placeholder="Masukkan password saat ini">
                            <button type="button" @click="show = !show"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                                <span class="material-symbols-outlined" x-show="!show" style="font-size: 20px;">visibility</span>
                                <span class="material-symbols-outlined" x-show="show" style="display: none; font-size: 20px;">visibility_off</span>
                            </button>
                        </div>
                        @error('current_password', 'updatePassword')
                            <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" x-data="{ show: false }">
                        <label for="password" class="form-label">Password Baru</label>
                        <div style="position: relative;">
                            <input id="password" name="password" :type="show ? 'text' : 'password'"
                                class="form-input" autocomplete="new-password" placeholder="Masukkan password baru">
                            <button type="button" @click="show = !show"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                                <span class="material-symbols-outlined" x-show="!show" style="font-size: 20px;">visibility</span>
                                <span class="material-symbols-outlined" x-show="show" style="display: none; font-size: 20px;">visibility_off</span>
                            </button>
                        </div>
                        @error('password', 'updatePassword')
                            <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" x-data="{ show: false }">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <div style="position: relative;">
                            <input id="password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'"
                                class="form-input" autocomplete="new-password" placeholder="Ulangi password baru">
                            <button type="button" @click="show = !show"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                                <span class="material-symbols-outlined" x-show="!show" style="font-size: 20px;">visibility</span>
                                <span class="material-symbols-outlined" x-show="show" style="display: none; font-size: 20px;">visibility_off</span>
                            </button>
                        </div>
                        @error('password_confirmation', 'updatePassword')
                            <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <span class="material-symbols-outlined" style="font-size: 20px;">key</span>
                        Ubah Password
                    </button>
                </form>
            </div>

            <!-- Panel Hapus Akun -->
            <div class="panel" x-data="{ showModal: false }">
                <div class="panel-header">
                    <span class="material-symbols-outlined" style="color: var(--danger-color);">warning</span>
                    <h2 class="panel-title">Zona Berbahaya</h2>
                </div>

                <p style="color: var(--gray-600); font-size: 0.875rem; margin-bottom: var(--spacing-lg); line-height: 1.6;">
                    Setelah akun Anda dihapus, semua data dan tugas akan dihapus secara permanen. 
                    Pastikan Anda sudah menyimpan data penting sebelum menghapus akun.
                </p>

                <button type="button" @click="showModal = true" class="btn btn-block"
                    style="background: var(--danger-bg); color: var(--danger-color); border: 2px solid var(--danger-color);">
                    <span class="material-symbols-outlined" style="font-size: 20px;">delete_forever</span>
                    Hapus Akun Saya
                </button>

                <!-- Modal Konfirmasi Hapus -->
                <div x-show="showModal" x-cloak
                    style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: var(--spacing-lg);">
                    <div class="panel" style="max-width: 400px; width: 100%;" @click.away="showModal = false">
                        <div style="text-align: center; margin-bottom: var(--spacing-lg);">
                            <div style="width: 64px; height: 64px; background: var(--danger-bg); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--spacing-md);">
                                <span class="material-symbols-outlined" style="font-size: 32px; color: var(--danger-color);">warning</span>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: var(--spacing-sm);">Hapus Akun?</h3>
                            <p style="color: var(--gray-600); font-size: 0.875rem; line-height: 1.6;">
                                Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.
                            </p>
                        </div>

                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="form-group" x-data="{ show: false }">
                                <label for="delete_password" class="form-label">Konfirmasi Password</label>
                                <div style="position: relative;">
                                    <input id="delete_password" name="password" :type="show ? 'text' : 'password'"
                                        class="form-input" placeholder="Masukkan password untuk konfirmasi">
                                    <button type="button" @click="show = !show"
                                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray-500);">
                                        <span class="material-symbols-outlined" x-show="!show" style="font-size: 20px;">visibility</span>
                                        <span class="material-symbols-outlined" x-show="show" style="display: none; font-size: 20px;">visibility_off</span>
                                    </button>
                                </div>
                                @error('password', 'userDeletion')
                                    <p class="form-hint" style="color: var(--danger-color);">{{ $message }}</p>
                                @enderror
                            </div>

                            <div style="display: flex; gap: var(--spacing-md);">
                                <button type="button" @click="showModal = false" class="btn btn-block"
                                    style="background: var(--gray-100); color: var(--gray-700); border: 2px solid var(--gray-200);">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-block"
                                    style="background: var(--danger-color); color: white;">
                                    Ya, Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>

</html>
