<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TaskFlow</title>
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">
    <link rel="icon" href="{{ asset('images/icon-todo.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <div class="main-container">
        <header class="app-header">
            <div class="brand">
                <div class="brand-icon">
                    <img src="{{ asset('images/icon-todo.png') }}" alt="icon-todo">
                </div>
                <div class="brand-content">
                    <h1>Dashboard</h1>
                    <p class="brand-tagline">Selamat datang, {{ Auth::user()->name }}!</p>
                </div>
            </div>
            <div class="header-right">
                <a href="/" class="btn btn-primary" style="text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 20px;">checklist</span>
                    Kelola Tugas
                </a>
            </div>
        </header>

        <div class="alert alert-success">
            <span class="material-symbols-outlined">check_circle</span>
            <span>Anda berhasil masuk! Selamat menggunakan TaskFlow.</span>
        </div>

        <div class="panel" style="max-width: 600px;">
            <div class="panel-header">
                <span class="material-symbols-outlined">rocket_launch</span>
                <h2 class="panel-title">Mulai Sekarang</h2>
            </div>
            <p style="color: var(--gray-600); margin-bottom: var(--spacing-lg); line-height: 1.6;">
                TaskFlow membantu Anda mengelola tugas dengan mudah dan efisien. 
                Tambahkan tugas baru, atur deadline, dan pantau progres Anda.
            </p>
            <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                <a href="/" class="btn btn-primary" style="text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 20px;">add_task</span>
                    Lihat Daftar Tugas
                </a>
                <a href="{{ route('profile.edit') }}" class="btn" style="background: var(--gray-100); color: var(--gray-700); border: 2px solid var(--gray-200); text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 20px;">settings</span>
                    Pengaturan Profil
                </a>
            </div>
        </div>
    </div>
</body>

</html>
