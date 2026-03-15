<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — PPKD Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

        :root{
            --ink:#08090C;
            --ink2:#111318;
            --ink3:#1A1D25;
            --gold:#BFA36A;
            --gold2:#D4BC8A;
            --gold3:#F0DFAD;
            --gold-dim:rgba(191,163,106,0.15);
            --gold-glow:rgba(191,163,106,0.08);
            --white:#FFFFFF;
            --off:#F8F5EF;
            --slate:#6B7280;
            --slate2:#9CA3AF;
        }

        html,body{
            height:100%;
            font-family:'Outfit',sans-serif;
            background:var(--ink);
            overflow:hidden;
        }

        /* ── FULL SCREEN SPLIT ── */
        .wrap{display:flex;height:100vh;width:100vw}

        /* Menghilangkan ikon mata bawaan Microsoft Edge */
    input::-ms-reveal,
    input::-ms-clear {
        display: none;
    }

        /* ── LEFT: editorial hero ── */
        .hero{
            flex:1;
            position:relative;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            padding:52px 56px;
            overflow:hidden;
            background:var(--ink);
        }

        /* Vertical gold lines pattern */
        .hero::before{
            content:'';
            position:absolute;
            inset:0;
            background-image:repeating-linear-gradient(
                90deg,
                rgba(191,163,106,0.03) 0px,
                rgba(191,163,106,0.03) 1px,
                transparent 1px,
                transparent 80px
            );
        }

        /* Diagonal sweep */
        .sweep{
            position:absolute;
            top:-20%;right:-15%;
            width:70%;height:120%;
            background:linear-gradient(135deg, rgba(191,163,106,0.04) 0%, transparent 60%);
            pointer-events:none;
        }

        /* Big decorative number */
        .hero-bg-text{
            position:absolute;
            bottom:-60px;left:-20px;
            font-family:'Cormorant',serif;
            font-size:340px;
            font-weight:300;
            color:rgba(191,163,106,0.03);
            line-height:1;
            user-select:none;
            pointer-events:none;
            letter-spacing:-20px;
        }

        /* Top bar */
        .hero-topbar{
            position:absolute;
            top:40px;left:56px;right:56px;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .hero-logo-row{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .hero-logo{
            width:44px;height:44px;
            border-radius:50%;
            object-fit:contain;
            mix-blend-mode:luminosity;
            filter:brightness(0.9) contrast(1.1) grayscale(0.3);
            border:1px solid rgba(191,163,106,0.2);
        }

        .hero-brand{
            font-family:'Cormorant',serif;
            font-size:16px;
            font-weight:600;
            color:var(--gold2);
            letter-spacing:4px;
            text-transform:uppercase;
        }

        .hero-year{
            font-size:11px;
            color:rgba(191,163,106,0.3);
            letter-spacing:3px;
        }

        /* Bottom content */
        .hero-bottom{position:relative;z-index:2}

        .hero-tag{
            display:inline-flex;
            align-items:center;
            gap:8px;
            margin-bottom:20px;
        }

        .hero-tag-line{width:24px;height:1px;background:var(--gold)}

        .hero-tag-text{
            font-size:10px;
            font-weight:500;
            letter-spacing:3px;
            color:var(--gold);
            text-transform:uppercase;
        }

        .hero-title{
            font-family:'Cormorant',serif;
            font-size:72px;
            font-weight:300;
            color:var(--white);
            line-height:0.95;
            letter-spacing:-1px;
            margin-bottom:28px;
        }

        .hero-title em{
            font-style:italic;
            color:var(--gold2);
            font-weight:300;
        }

        .hero-desc{
            font-size:13px;
            font-weight:300;
            color:var(--slate2);
            line-height:1.7;
            max-width:340px;
            border-left:1px solid rgba(191,163,106,0.25);
            padding-left:18px;
        }

        /* ── DIVIDER LINE ── */
        .divider-v{
            width:1px;
            background:linear-gradient(180deg, transparent 0%, rgba(191,163,106,0.2) 20%, rgba(191,163,106,0.2) 80%, transparent 100%);
            flex-shrink:0;
        }

        /* ── RIGHT: login form ── */
        .panel{
            width:460px;
            min-width:460px;
            background:var(--ink2);
            display:flex;
            flex-direction:column;
            justify-content:center;
            padding:56px 52px;
            position:relative;
            overflow:hidden;
        }

        /* Subtle corner glow */
        .panel::before{
            content:'';
            position:absolute;
            top:-100px;right:-100px;
            width:300px;height:300px;
            border-radius:50%;
            background:radial-gradient(circle, rgba(191,163,106,0.06) 0%, transparent 70%);
            pointer-events:none;
        }

        /* Bottom pattern */
        .panel::after{
            content:'';
            position:absolute;
            bottom:0;left:0;right:0;
            height:2px;
            background:linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        /* Form header */
        .panel-label{
            font-size:10px;
            font-weight:500;
            letter-spacing:4px;
            text-transform:uppercase;
            color:var(--gold);
            margin-bottom:14px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .panel-label::after{
            content:'';
            flex:1;
            height:1px;
            background:rgba(191,163,106,0.2);
        }

        .panel-title{
            font-family:'Cormorant',serif;
            font-size:38px;
            font-weight:400;
            color:var(--white);
            line-height:1.1;
            margin-bottom:6px;
        }

        .panel-sub{
            font-size:12px;
            font-weight:300;
            color:var(--slate);
            margin-bottom:36px;
            letter-spacing:0.5px;
        }

        /* ALERTS */
        .alert{
            padding:10px 14px;
            margin-bottom:20px;
            font-size:12px;
            display:flex;
            align-items:center;
            gap:8px;
            border-radius:4px;
            border:1px solid;
        }
        .alert-error{background:rgba(220,38,38,0.08);border-color:rgba(220,38,38,0.25);color:#FCA5A5}
        .alert-success{background:rgba(34,197,94,0.08);border-color:rgba(34,197,94,0.25);color:#86EFAC}
        .alert svg{width:13px;height:13px;flex-shrink:0}

        /* FIELDS */
        .field{margin-bottom:20px}

        .field-label{
            display:block;
            font-size:10px;
            font-weight:500;
            letter-spacing:2px;
            text-transform:uppercase;
            color:var(--slate);
            margin-bottom:8px;
        }

        .field-wrap{position:relative}

        .field-icon{
            position:absolute;
            left:14px;top:50%;
            transform:translateY(-50%);
            width:14px;height:14px;
            color:rgba(191,163,106,0.4);
            pointer-events:none;
        }

        .field-input{
            width:100%;
            padding:14px 40px 14px 42px;
            background:var(--ink3);
            border:1px solid rgba(191,163,106,0.12);
            border-radius:6px;
            font-family:'Outfit',sans-serif;
            font-size:13px;
            color:var(--white);
            outline:none;
            transition:all 0.25s;
            letter-spacing:0.3px;
        }

        .field-input::placeholder{
            color:rgba(107,114,128,0.6);
            font-size:12px;
        }

        .field-input:hover{border-color:rgba(191,163,106,0.25)}

        .field-input:focus{
            border-color:var(--gold);
            background:rgba(191,163,106,0.04);
            box-shadow:0 0 0 3px rgba(191,163,106,0.08);
        }

        .field-input.is-invalid{
            border-color:rgba(220,38,38,0.5);
            box-shadow:0 0 0 3px rgba(220,38,38,0.08);
        }

        .field-error{font-size:11px;color:#FCA5A5;margin-top:5px}

        .toggle-pw{
            position:absolute;right:13px;top:50%;
            transform:translateY(-50%);
            background:none;border:none;cursor:pointer;
            color:rgba(107,114,128,0.5);padding:0;display:flex;
            transition:color 0.2s;
        }
        .toggle-pw:hover{color:var(--gold)}
        .toggle-pw svg{width:14px;height:14px}

        /* REMEMBER */
        .remember-row{
            display:flex;align-items:center;gap:10px;
            margin-bottom:28px;
        }
        .remember-row input[type="checkbox"]{
            accent-color:var(--gold);
            width:14px;height:14px;cursor:pointer;
        }
        .remember-row label{
            font-size:12px;color:var(--slate);cursor:pointer;
        }

        /* SUBMIT */
        .btn-submit{
            width:100%;
            padding:15px;
            background:transparent;
            border:1px solid var(--gold);
            border-radius:6px;
            font-family:'Outfit',sans-serif;
            font-size:11px;
            font-weight:600;
            letter-spacing:4px;
            text-transform:uppercase;
            color:var(--gold);
            cursor:pointer;
            transition:all 0.3s;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:12px;
            position:relative;
            overflow:hidden;
        }

        .btn-submit::before{
            content:'';
            position:absolute;
            inset:0;
            background:var(--gold);
            transform:translateX(-100%);
            transition:transform 0.35s cubic-bezier(0.4,0,0.2,1);
        }

        .btn-submit:hover{color:var(--ink)}
        .btn-submit:hover::before{transform:translateX(0)}

        .btn-submit span,.btn-submit svg{position:relative;z-index:1}
        .btn-submit svg{width:14px;height:14px}

        /* FOOTER */
        .panel-footer{
            margin-top:32px;
            padding-top:22px;
            border-top:1px solid rgba(191,163,106,0.1);
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .footer-badge{
            display:inline-flex;align-items:center;gap:6px;
            padding:4px 12px;
            border:1px solid rgba(191,163,106,0.2);
            border-radius:20px;
            font-size:10px;
            font-weight:500;
            color:rgba(191,163,106,0.6);
            letter-spacing:2px;
            text-transform:uppercase;
        }

        .footer-copy{
            font-size:10px;
            color:rgba(107,114,128,0.4);
            text-align:right;
            line-height:1.6;
        }

        @media(max-width:900px){
            .hero{display:none}
            .divider-v{display:none}
            .panel{width:100%;min-width:unset;padding:36px 28px}
        }
    </style>
</head>
<body>
<div class="wrap">

    <!-- HERO LEFT -->
    <div class="hero">
        <div class="sweep"></div>
        <div class="hero-bg-text">H</div>

        <!-- Top bar -->
        <div class="hero-topbar">
            <div class="hero-logo-row">
                <img src="{{ asset('images/logo.jpeg') }}"
                     alt="PPKD"
                     class="hero-logo"
                     onerror="this.style.display='none'">
                <span class="hero-brand">PPKD Hotel</span>
            </div>
            <span class="hero-year">Est. {{ date('Y') }}</span>
        </div>

        <!-- Bottom editorial content -->
        <div class="hero-bottom">
            <div class="hero-tag">
                <div class="hero-tag-line"></div>
                <span class="hero-tag-text">Management System</span>
            </div>
            <div class="hero-title">
               <em>Kelola</em> <br>
                <em>Reservasi</em><br>
                <em>Hotel</em>
            </div>
            <p class="hero-desc">
                Sistem manajemen terpadu untuk resepsionis PPKD Hotel Jakarta Pusat. Catat, konfirmasi, dan cetak reservasi tamu dengan mudah.
            </p>
        </div>
    </div>

    <!-- DIVIDER -->
    <div class="divider-v"></div>

    <!-- FORM RIGHT -->
    <div class="panel">

        <div class="panel-label">Akses Sistem</div>
        <div class="panel-title">Masuk</div>
        <div class="panel-sub">Gunakan kredensial yang diberikan admin</div>

        @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="field">
                <label class="field-label" for="email">Email</label>
                <div class="field-wrap">
                    <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input type="email" id="email" name="email"
                           class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="email@ppkdhotel.com"
                           value="{{ old('email') }}"
                           autocomplete="email" autofocus>
                </div>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label class="field-label" for="password">Password</label>
                <div class="field-wrap">
                    <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input type="password" id="password" name="password"
                           class="field-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="••••••••"
                           autocomplete="current-password">
                    <button type="button" class="toggle-pw" onclick="togglePw()">
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="btn-submit">
                <span>Masuk</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </form>

        <div class="panel-footer">
            <div class="footer-badge">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:10px;height:10px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Resepsionis
            </div>
            <div class="footer-copy">
                © {{ date('Y') }} PPKD Jakarta Pusat<br>
                Disnakertransgi DKI Jakarta
            </div>
        </div>
    </div>
</div>

<script>
function togglePw(){
    const inp=document.getElementById('password');
    const ico=document.getElementById('eye-icon');
    if(inp.type==='password'){
        inp.type='text';
        ico.innerHTML='<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
    }else{
        inp.type='password';
        ico.innerHTML='<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}
document.addEventListener('DOMContentLoaded',function(){
    document.querySelectorAll('.alert').forEach(function(el){
        setTimeout(function(){
            el.style.transition='opacity 0.5s,transform 0.5s';
            el.style.opacity='0';el.style.transform='translateY(-8px)';
            setTimeout(function(){el.remove()},500);
        },3000);
    });
});
</script>
</body>
</html>