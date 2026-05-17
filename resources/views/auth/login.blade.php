<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Pixel Barbershop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --green-dark: #1b4332;
            --green-mid: #2d6a4f;
            --green-bg: #a8d5a2;
            --cream: #f0f0e8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--green-bg);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── HEADER ──────────────────── */
        header.login-header {
            background-color: var(--green-dark);
            padding: 0.65rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .brand-pixel {
            font-family: 'Jersey 15', cursive;
            font-size: 1.6rem;
            color: #fff;
            letter-spacing: 2px;
            line-height: 1;
        }

        .brand-sub {
            font-family: 'Jersey 15', cursive;
            font-size: 0.62rem;
            font-weight: 400;
            color: #d8f3dc;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* ── CENTER WRAP ─────────────── */
        .login-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* ── CARD ────────────────────── */
        .login-card {
            background: var(--cream);
            border-radius: 20px;
            padding: 2.2rem 2rem 2rem;
            width: 100%;
            max-width: 370px;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.1);
        }

        .login-card h2 {
            font-family: 'Inter', sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            color: var(--green-dark);
            text-align: center;
            margin-bottom: 0.1rem;
        }

        .login-divider {
            border: none;
            border-top: 1.5px solid #bbb;
            margin: 0.65rem 0 1.4rem;
        }

        /* ── FORM ────────────────────── */
        /* .form-label-pixel {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--green-dark);
            margin-bottom: 0.3rem;
            text-transform: uppercase;
            display: block;
        } */
        .form-label-pixel {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--green-dark);
            margin-bottom: 0.45rem;
            text-transform: uppercase;
            display: block;
            text-align: center;
        }

        /* .form-control-pixel {
            width: 100%;
            border: 1.5px solid #c8c8c0;
            border-radius: 10px;
            background: #fff;
            padding: 0.55rem 1rem;
            font-size: 0.9rem;
            color: #888;
            outline: none;
            transition: border-color 0.2s;
        } */
        .form-control-pixel {
            width: 100%;
            border: 1.5px solid #c8c8c0;
            border-radius: 10px;
            background: #fff;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            color: #444;
            outline: none;
            transition: border-color 0.2s;
            text-align: center;
        }


        .form-control-pixel:focus {
            border-color: var(--green-mid);
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.15);
        }

        .login-divider-bottom {
            border: none;
            border-top: 1px solid #bbb;
            margin: 1.4rem 0 1.2rem;
        }

        /* ── BUTTON ──────────────────── */
        .btn-login {
            background-color: var(--green-dark);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-family: 'Jersey 25', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            padding: 0.7rem;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background-color: var(--green-mid);
        }

        /* ── ERROR ───────────────────── */
        .error-msg {
            background: #fee2e2;
            border-left: 4px solid #dc3545;
            color: #991b1b;
            border-radius: 8px;
            font-size: 0.8rem;
            padding: 0.6rem 0.9rem;
            margin-bottom: 1rem;
        }

        /* ── FOOTER ──────────────────── */
        footer.login-footer {
            background-color: var(--cream);
            text-align: center;
            font-size: 0.78rem;
            color: #6b7280;
            padding: 0.85rem;
            border-top: 1px solid #ddd;
        }

        .password-wrap {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
            font-size: 0.95rem;
        }

        .logo-pixel {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <header class="login-header">
        {{-- <svg width="26" height="38" viewBox="0 0 32 52" fill="none">
            <rect x="13" y="0" width="6" height="52" rx="3" fill="#e5e5e5" />
            <path d="M13 2 Q16 6 19 10 Q16 14 13 18 Q16 22 19 26 Q16 30 13 34 Q16 38 19 42 Q16 46 13 50"
                stroke="#e63946" stroke-width="2.5" fill="none" />
            <path d="M19 2 Q16 6 13 10 Q16 14 19 18 Q16 22 13 26 Q16 30 19 34 Q16 38 13 42 Q16 46 19 50"
                stroke="#1d3557" stroke-width="2.5" fill="none" />
            <ellipse cx="16" cy="2" rx="5" ry="2.5" fill="#f1faee" />
            <ellipse cx="16" cy="50" rx="5" ry="2.5" fill="#f1faee" />
        </svg> --}}
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-pixel">
        <div>
            <div class="brand-pixel">PIXEL</div>
            <div class="brand-sub">Barbershop</div>
        </div>
    </header>

    {{-- Center --}}
    <div class="login-wrap">
        <div class="login-card">

            <h2>Halaman Log in</h2>
            <hr class="login-divider">

            @if ($errors->any())
                <div class="error-msg">{{ $errors->first('username') ?? $errors->first() }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label-pixel">Username</label>
                    <input type="text" name="username" class="form-control-pixel" placeholder="Ketik Username"
                        value="{{ old('username') }}" autocomplete="username" required>
                </div>

                {{-- <div class="mb-1">
                    <label class="form-label-pixel">Password</label>
                    <input type="password" name="password" class="form-control-pixel" placeholder="Ketik Password"
                        autocomplete="current-password" required>
                </div> --}}
                <div class="mb-1">
                    <label class="form-label-pixel">Password</label>

                    <div class="password-wrap">
                        <input type="password" id="passwordInput" name="password" class="form-control-pixel"
                            placeholder="Ketik Password" autocomplete="current-password" required>

                        <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                    </div>
                </div>
                <hr class="login-divider-bottom">

                <button type="submit" class="btn-login">LOGIN</button>
            </form>
        </div>
    </div>

    <footer class="login-footer">Copyright 20XX</footer>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        togglePassword.addEventListener('click', () => {

            const type =
                passwordInput.getAttribute('type') === 'password' ?
                'text' :
                'password';

            passwordInput.setAttribute('type', type);

            togglePassword.classList.toggle('bi-eye');
            togglePassword.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>
