<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pixel Barbershop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --green-dark: #1b4332;
            --green-mid: #2d6a4f;
            --green-light: #8fbc8f;
            --green-bg: #a8d5a2;
            --green-pale: #d8f3dc;
            --cream: #f0f0e8;
            --white: #ffffff;
            --text-dark: #1a1a1a;
            --text-muted: #6b7280;
            --red-accent: #dc3545;
            --yellow: #f9c74f;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--green-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /*  NAVBAR ─ */
        .navbar-pixel {
            background-color: var(--green-dark);
            padding: 0.55rem 1.8rem;
            position: sticky;
            top: 0;
            z-index: 1050;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        .brand-pixel {
            font-family: 'Jersey 15', cursive;
            font-size: 1.7rem;
            color: var(--white);
            letter-spacing: 2px;
            line-height: 1;
            text-decoration: none;
        }

        .brand-sub {
            font-family: 'Jersey 15', cursive;
            font-size: 0.65rem;
            font-weight: 400;
            color: var(--green-pale);
            letter-spacing: 3px;
            text-transform: uppercase;
            line-height: 1;
            text-decoration: none;
        }

        .nav-link-pixel {
            color: var(--white) !important;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 0.35rem 0.9rem !important;
            border-radius: 8px;
            transition: background 0.2s;
            text-decoration: none;
        }

        .nav-link-pixel:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .nav-link-pixel.active {
            background: rgba(255, 255, 255, 0.22);
            font-weight: 600;
        }

        .logo-pixel {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        /*  USER TRIGGER ─ */
        .user-trigger {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--white);
            font-size: 0.88rem;
            font-weight: 500;
            position: relative;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #c9b8e8;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /*  USER POPUP ─ */
        .user-popup {
            display: none;
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: var(--white);
            border-radius: 14px;
            box-shadow: 0 10px 36px rgba(0, 0, 0, 0.18);
            padding: 1.1rem 1.2rem;
            min-width: 230px;
            z-index: 2000;
        }

        .user-popup.show {
            display: block;
        }

        .popup-row {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.15rem;
            letter-spacing: 0.2px;
        }

        .popup-divider {
            border: none;
            border-top: 1px solid ;
            margin: 0.75rem 0;
            color: #204E37;
        }

        .popup-btn {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            width: 100%;
            padding: 0.48rem 0.8rem;
            border-radius: 8px;
            border: 1.5px solid var(--green-dark);
            background: transparent;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--green-dark);
            text-decoration: none;
            cursor: pointer;
            margin-bottom: 0.45rem;
            transition: background 0.15s;
            letter-spacing: 0.5px;
        }

        .popup-btn:hover {
            background: var(--green-pale);
            color: var(--green-dark);
        }

        .popup-btn.danger {
            border-color: var(--red-accent);
            color: var(--red-accent);
            margin-bottom: 0;
        }

        .popup-btn.danger:hover {
            background: #fff0f0;
        }

        /*  MAIN & FOOTER  */
        main {
            flex: 1;
            padding: 1.8rem 1.5rem;
        }

        footer.site-footer {
            background-color: var(--cream);
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-muted);
            padding: 0.85rem 1rem;
            border-top: 1px solid #ddd;
        }

        /*  CARDS  */
        .card-pixel {
            background: var(--cream);
            border-radius: 18px;
            border: none;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.07);
        }

        .stat-card {
            background-color: var(--green-mid);
            color: var(--white);
            border-radius: 14px;
            padding: 1.1rem 1rem;
            height: 100%;
        }

        .stat-card .stat-label {
            font-size: 0.72rem;
            font-weight: 500;
            opacity: 0.88;
            margin-bottom: 0.6rem;
            letter-spacing: 0.3px;
            text-align: center;
        }

        .stat-card .stat-value {
            font-size: 2.6rem;
            font-weight: 700;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: 0.85;
        }

        .stat-card .stat-sub {
            font-size: 0.7rem;
            opacity: 0.75;
            margin-top: 0.4rem;
            text-align: center;
        }

        /*  STATUS BADGE ─ */
        .status-badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.28rem 0.75rem;
            border-radius: 20px;
            letter-spacing: 0.5px;
            color: white;
            white-space: nowrap;
        }

        .status-badge.available {
            background-color: var(--green-mid);
        }

        .status-badge.busy {
            background-color: var(--red-accent);
        }

        .status-badge.off {
            background-color: #4b4b4b;
        }

        /*  STATUS DROPDOWN  */
        .status-dropdown-wrap {
            position: relative;
        }

        .status-dropdown-trigger {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .status-chevron {
            font-size: 0.7rem;
            color: var(--green-dark);
        }

        .status-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 6px);
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
            padding: 0.7rem 0.8rem;
            z-index: 500;
            min-width: 150px;
        }

        .status-dropdown-menu.show {
            display: block;
        }

        .status-dropdown-menu .menu-title {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .status-option {
            display: block;
            width: 100%;
            text-align: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.3rem 0.6rem;
            margin-bottom: 0.35rem;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: opacity 0.15s;
        }

        .status-option:last-child {
            margin-bottom: 0;
        }

        .status-option:hover {
            opacity: 0.82;
        }

        .status-option.available {
            background-color: var(--green-mid);
        }

        .status-option.busy {
            background-color: var(--red-accent);
        }

        .status-option.off {
            background-color: #4b4b4b;
        }

        /*  FEEDBACK ─ */
        .feedback-item {
            padding: 0.65rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .feedback-item:last-child {
            border-bottom: none;
        }

        .feedback-name {
            font-size: 0.85rem;
            font-weight: 600;
        }

        .feedback-quote {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-style: italic;
        }

        .star-rating {
            color: var(--yellow);
            font-size: 0.8rem;
        }

        /*  TABLE  */
        .table-pixel thead {
            background-color: var(--green-mid);
            color: var(--white);
        }

        .table-pixel thead th {
            font-weight: 600;
            border: none;
        }

        .table-pixel tbody tr:hover {
            background-color: var(--green-pale);
        }

        /*  BUTTONS  */
        .btn-pixel-primary {
            background-color: var(--green-dark);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0.55rem 1.4rem;
            transition: background 0.2s;
            cursor: pointer;
        }

        .btn-pixel-primary:hover {
            background-color: var(--green-mid);
            color: white;
        }

        .btn-pixel-teal {
            background-color: #4a9ead;
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            padding: 0.55rem 1.4rem;
            transition: background 0.2s;
            cursor: pointer;
        }

        .btn-pixel-teal:hover {
            background-color: #3a8a9a;
            color: white;
        }

        /*  FLASH MESSAGES ─ */
        .alert-pixel-success {
            background-color: var(--green-pale);
            border-left: 4px solid var(--green-mid);
            color: var(--green-dark);
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .alert-pixel-error {
            background-color: #fee2e2;
            border-left: 4px solid var(--red-accent);
            color: #991b1b;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        /*  LOGOUT OVERLAY ─ */
        .logout-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 3000;
            align-items: center;
            justify-content: center;
        }

        .logout-overlay.show {
            display: flex;
        }

        .logout-box {
            background: var(--cream);
            border-radius: 18px;
            padding: 2rem 2.2rem;
            text-align: center;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            min-width: 260px;
        }

        .logout-box h5 {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
        }

        .logout-divider {
            border: none;
            border-top: 1.5px solid #ccc;
            margin: 0.8rem 0 1.2rem;
        }

        .logout-btn-wrap {
            display: flex;
            gap: 0.8rem;
            justify-content: center;
        }

        .btn-logout-tidak {
            border: 2px solid #4a9ead;
            color: #4a9ead;
            background: transparent;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 0.45rem 1.3rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-logout-tidak:hover {
            background: #e0f4f7;
        }

        .btn-logout-keluar {
            border: 2px solid var(--red-accent);
            color: var(--red-accent);
            background: transparent;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 0.45rem 1.3rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-logout-keluar:hover {
            background: #fff0f0;
        }

        /*  PASSWORD SHOW/HIDE  */
        .pw-wrap {
            position: relative;
        }

        .pw-wrap .form-control {
            padding-right: 2.6rem;
        }

        .pw-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            font-size: 1rem;
            padding: 0;
            line-height: 1;
        }

        .pw-toggle:hover {
            color: #4b5563;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ═══ NAVBAR ═══════════════════════════════════════════════════════════ --}}
    @auth
        <nav class="navbar-pixel d-flex align-items-center justify-content-between">

            {{-- Brand --}}
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-pixel">
                <div>
                    <div class="brand-pixel">PIXEL</div>
                    <div class="brand-sub">Barbershop</div>
                </div>
            </a>

            {{-- Nav links --}}
            <div class="d-flex align-items-center gap-1">
                <a href="{{ route('dashboard') }}"
                    class="nav-link-pixel {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('profile') }}"
                    class="nav-link-pixel {{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('staff.index') }}"
                    class="nav-link-pixel {{ request()->routeIs('staff.*') ? 'active' : '' }}">Staff</a>

                {{-- User dropdown --}}
                <div class="user-trigger ms-2" id="userTrigger">
                    <div class="avatar-circle">
                        @if (Auth::user()->foto)
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="avatar">
                        @else
                            <i class="bi bi-person-fill" style="font-size:1.2rem; color:#7c5cbf;"></i>
                        @endif
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                    <i class="bi bi-chevron-down" style="font-size:0.65rem;"></i>

                    {{-- Popup --}}
                    <div class="user-popup" id="userPopup">
                        <div class="popup-row">NAME &nbsp;&nbsp;: &nbsp;{{ strtoupper(Auth::user()->name) }}</div>

                        {{-- Status online/offline — diisi JS, bukan hardcode --}}
                        <div class="popup-row d-flex align-items-center gap-1">
                            STATUS :&nbsp;
                            <span id="onlineStatus" style="font-weight:700;">–</span>
                            <span id="onlineDot"
                                style="display:inline-block;width:8px;height:8px;border-radius:50%;
                                 flex-shrink:0;transition:background .3s;"></span>
                        </div>

                        <hr class="popup-divider">

                        <a href="{{ route('profile') }}" class="popup-btn">
                            <i class="bi bi-gear-fill"></i> SETTING
                        </a>

                        <button type="button" class="popup-btn danger" id="logoutTrigger">
                            <i class="bi bi-box-arrow-right"></i> LOG OUT
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Hidden logout form --}}
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

        {{-- Logout confirmation overlay --}}
        <div class="logout-overlay" id="logoutOverlay">
            <div class="logout-box">
                <h5>APAKAH YAKIN INGIN<br>KELUAR?</h5>
                <hr class="logout-divider">
                <div class="logout-btn-wrap">
                    <button class="btn-logout-tidak" id="logoutCancel">TIDAK</button>
                    <button class="btn-logout-keluar" id="logoutConfirm">KELUAR</button>
                </div>
            </div>
        </div>
    @endauth

    {{-- MAIN CONTENT  --}}
    <main>
        @if (session('success'))
            <div class="alert-pixel-success p-3 mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('success_password'))
            <div class="alert-pixel-success p-3 mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i> {{ session('success_password') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-pixel-error p-3 mb-3">
                @foreach ($errors->all() as $error)
                    <div><i class="bi bi-exclamation-circle"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        @yield('contents')
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        //  User popup toggle 
        const userTrigger = document.getElementById('userTrigger');
        const userPopup = document.getElementById('userPopup');

        if (userTrigger && userPopup) {
            userTrigger.addEventListener('click', e => {
                e.stopPropagation();
                userPopup.classList.toggle('show');
            });
            document.addEventListener('click', () => userPopup.classList.remove('show'));
            userPopup.addEventListener('click', e => e.stopPropagation());
        }

        //  Logout modal 
        const logoutTrigger = document.getElementById('logoutTrigger');
        const logoutOverlay = document.getElementById('logoutOverlay');
        const logoutCancel = document.getElementById('logoutCancel');
        const logoutConfirm = document.getElementById('logoutConfirm');
        const logoutForm = document.getElementById('logoutForm');

        if (logoutTrigger) {
            logoutTrigger.addEventListener('click', e => {
                e.stopPropagation();
                userPopup.classList.remove('show');
                logoutOverlay.classList.add('show');
            });
        }

        if (logoutCancel) logoutCancel.addEventListener('click', () => logoutOverlay.classList.remove('show'));
        if (logoutConfirm) logoutConfirm.addEventListener('click', () => logoutForm.submit());

        if (logoutOverlay) {
            logoutOverlay.addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('show');
            });
        }

        //  Status online/offline realtime (ping ke server eksternal) 
        function setOnlineUI(isOnline) {
            const statusEl = document.getElementById('onlineStatus');
            const dotEl = document.getElementById('onlineDot');
            if (!statusEl || !dotEl) return;

            if (isOnline) {
                statusEl.textContent = 'ONLINE';
                statusEl.style.color = '#16a34a';
                dotEl.style.background = '#16a34a';
                dotEl.style.boxShadow = '0 0 0 2px rgba(22,163,74,0.3)';
            } else {
                statusEl.textContent = 'OFFLINE';
                statusEl.style.color = '#dc3545';
                dotEl.style.background = '#dc3545';
                dotEl.style.boxShadow = '0 0 0 2px rgba(220,53,69,0.3)';
            }
        }

        // Fetch ke URL eksternal dengan cache-bust — kalau gagal = tidak ada internet
        // Menggunakan favicon Google (1x1px, sangat kecil, tidak butuh banyak bandwidth)
        function checkRealInternet() {
            fetch('https://www.google.com/favicon.ico?_=' + Date.now(), {
                    mode: 'no-cors', // hindari CORS error
                    cache: 'no-store', // selalu request baru, jangan pakai cache
                })
                .then(() => setOnlineUI(true))
                .catch(() => setOnlineUI(false));
        }

        // Cek pertama kali saat halaman load
        checkRealInternet();

        // Cek ulang setiap 10 detik
        setInterval(checkRealInternet, 10000);

        // Tetap pakai event browser sebagai trigger tambahan (respons instan)
        window.addEventListener('online', checkRealInternet);
        window.addEventListener('offline', () => setOnlineUI(false));

        //  Show/hide password (dipakai di semua halaman) ─
        function togglePw(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye-slash';
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
