<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — PPKD Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:       #C9A84C;
            --gold-light: #E8C97A;
            --gold-dark:  #9A7B35;
            --charcoal:   #1C1C1E;
            --cream:      #F9F5EE;
            --white:      #FFFFFF;
            --text-soft:  #8C8C8E;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--charcoal);
            overflow: hidden;
        }

        /* === LEFT PANEL === */
        .left-panel {
            flex: 1;
            background: var(--charcoal);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative background pattern */
        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px; left: -100px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px; right: -80px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,168,76,0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Decorative corner lines */
        .corner-tl, .corner-br {
            position: absolute;
            width: 60px; height: 60px;
        }
        .corner-tl {
            top: 32px; left: 32px;
            border-top: 1px solid rgba(201,168,76,0.3);
            border-left: 1px solid rgba(201,168,76,0.3);
        }
        .corner-br {
            bottom: 32px; right: 32px;
            border-bottom: 1px solid rgba(201,168,76,0.3);
            border-right: 1px solid rgba(201,168,76,0.3);
        }

        .left-logo {
            width: 90px;
            height: 90px;
            object-fit: contain;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 4px 20px rgba(201,168,76,0.3));
        }

        .left-logo-fallback {
            width: 90px;
            height: 90px;
            border: 2px solid rgba(201,168,76,0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            font-size: 32px;
            position: relative;
            z-index: 1;
        }

        .left-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 42px;
            font-weight: 600;
            color: var(--gold);
            letter-spacing: 3px;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            position: relative;
            z-index: 1;
        }

        .left-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 16px 0;
            width: 200px;
            position: relative;
            z-index: 1;
        }

        .left-divider::before,
        .left-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(201,168,76,0.3);
        }

        .left-divider span {
            color: var(--gold);
            font-size: 10px;
        }

        .left-subtitle {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            letter-spacing: 4px;
            text-transform: uppercase;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .left-tagline {
            margin-top: 48px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .left-tagline p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            font-style: italic;
            color: rgba(255,255,255,0.25);
            line-height: 1.6;
        }

        /* === RIGHT PANEL === */
        .right-panel {
            width: 460px;
            min-width: 460px;
            background: var(--cream);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            position: relative;
        }

        .right-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px; height: 100%;
            background: linear-gradient(180deg, transparent, var(--gold), transparent);
        }

        .login-heading {
            margin-bottom: 8px;
        }

        .login-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 600;
            color: var(--charcoal);
            letter-spacing: 0.5px;
        }

        .login-subtitle {
            font-size: 11px;
            color: var(--text-soft);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .login-divider {
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), var(--gold-light));
            margin: 20px 0 32px;
            border-radius: 2px;
        }

        /* ALERT */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-size: 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-error {
            background: rgba(220,38,38,0.08);
            border: 1px solid rgba(220,38,38,0.2);
            color: #991B1B;
        }
        .alert-success {
            background: rgba(34,197,94,0.08);
            border: 1px solid rgba(34,197,94,0.2);
            color: #166534;
        }
        .alert svg { width:16px; height:16px; flex-shrink:0; margin-top:1px; }

        /* FORM */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #5C5C5E;
            margin-bottom: 8px;
        }

        .form-input-wrap {
            position: relative;
        }

        .form-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: var(--text-soft);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 13px 16px 13px 42px;
            border: 1px solid #E0D8CC;
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            color: var(--charcoal);
            background: #FFFFFF;
            outline: none;
            transition: all 0.25s;
        }

        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.12);
            background: #FFFDF8;
        }

        .form-input.is-invalid {
            border-color: #DC2626;
            box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
        }

        .form-error {
            font-size: 11px;
            color: #DC2626;
            margin-top: 5px;
        }

        /* REMEMBER ME */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .remember-row input[type="checkbox"] {
            accent-color: var(--gold);
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .remember-row label {
            font-size: 12px;
            color: #5C5C5E;
            cursor: pointer;
        }

        /* SUBMIT BUTTON */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: white;
            border: none;
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(201,168,76,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(201,168,76,0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login svg { width: 16px; height: 16px; }

        /* FOOTER INFO */
        .login-footer {
            margin-top: 36px;
            padding-top: 24px;
            border-top: 1px solid rgba(201,168,76,0.2);
        }

        .login-footer-text {
            font-size: 10px;
            color: var(--text-soft);
            text-align: center;
            letter-spacing: 0.5px;
            line-height: 1.6;
        }

        .login-footer-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
        }

        .badge-role {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.25);
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            color: var(--gold-dark);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; min-width: unset; padding: 40px 24px; }
            .right-panel::before { display: none; }
        }
    </style>
</head>
<body>

    <!-- LEFT PANEL -->
    <div class="left-panel">
        <div class="corner-tl"></div>
        <div class="corner-br"></div>

        <img src="{{ asset('images/logo.jpeg') }}"
             alt="PPKD"
             class="left-logo"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="left-logo-fallback" style="display:none;">🏨</div>

        <div class="left-title">PPKD<br>Hotel</div>

        <div class="left-divider">
            <span>◆</span>
        </div>

        <div class="left-subtitle">Jakarta Pusat</div>

        <div class="left-tagline">
            <p>"Melayani dengan sepenuh hati,<br>setiap tamu adalah prioritas kami."</p>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">

        <div class="login-heading">
            <div class="login-title">Selamat Datang</div>
            <div class="login-subtitle">Masuk ke sistem hotel</div>
        </div>
        <div class="login-divider"></div>

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <div class="form-input-wrap">
                    <svg class="form-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input type="email"
                           id="email"
                           name="email"
                           class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="email@ppkdhotel.com"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           autofocus>
                </div>
                @error('email')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="form-input-wrap">
                    <svg class="form-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="••••••••"
                           autocomplete="current-password">
                </div>
                @error('password')
                <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- REMEMBER --}}
            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat saya di perangkat ini</label>
            </div>

            {{-- SUBMIT --}}
            <button type="submit" class="btn-login">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </button>
        </form>

        {{-- FOOTER --}}
        <div class="login-footer">
            <div class="login-footer-badge">
                <span class="badge-role">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:11px;height:11px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Resepsionis
                </span>
            </div>
            <div class="login-footer-text" style="margin-top:10px;">
                © {{ date('Y') }} PPKD Hotel Jakarta Pusat<br>
                Dinas Tenaga Kerja, Transmigrasi dan Energi
            </div>
        </div>
    </div>

</body>
</html>
