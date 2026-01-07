<x-guest-layout>
    <div class="panel" style="max-width: 400px; margin: 0 auto; width: 100%;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div class="brand-icon"
                style="margin: 0 auto 1rem; width: 80px; height: 80px; background: #fff; box-shadow: var(--shadow-md);">
                <img src="{{ asset('images/icon-todo.png') }}" alt="logo" style="width: 50px; height: 50px;">
            </div>
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900);">Verifikasi Email</h2>
            <p style="color: var(--gray-500); margin-top: 0.5rem; line-height: 1.6;">
                Terima kasih sudah mendaftar! Silakan verifikasi email Anda dengan klik link yang sudah kami kirim.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" style="margin-bottom: 1.5rem;">
                <span class="material-symbols-outlined">check_circle</span>
                <span>Link verifikasi baru telah dikirim ke email Anda.</span>
            </div>
        @endif

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-block">
                    <span class="material-symbols-outlined" style="font-size: 20px;">mail</span>
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-block"
                    style="background: var(--gray-100); color: var(--gray-700); border: 2px solid var(--gray-200);">
                    <span class="material-symbols-outlined" style="font-size: 20px;">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
