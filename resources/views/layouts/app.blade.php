<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPKD Hotel') — Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
<div class="app-wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            {{-- Logo di kiri, teks di kanan --}}
            <div style="display:flex; align-items:center; gap:12px;">
                <img src="{{ asset('images/logo.jpeg') }}"
                     alt="PPKD Jakarta Pusat"
                     style="width:48px; height:48px; object-fit:contain; flex-shrink:0; border-radius:4px;"
                     onerror="this.style.display='none'">
                <div style="display:flex; flex-direction:column; line-height:1.3;">
                    <span class="sidebar-brand">PPKD Hotel</span>
                    <span class="sidebar-tagline">Jakarta Pusat</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-section-label">Menu Utama</span>

            <a href="{{ route('reservations.index') }}"
               class="nav-item {{ request()->routeIs('reservations.index') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('reservations.create') }}"
               class="nav-item {{ request()->routeIs('reservations.create') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Reservasi Baru
            </a>

            <a href="{{ route('reservations.index') }}"
               class="nav-item {{ request()->routeIs('reservations.show', 'reservations.edit') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Data Reservasi
            </a>

            {{-- <span class="nav-section-label">Informasi</span>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profil Tamu
            </a>

            <a href="#" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Laporan
            </a> --}}
        </nav>

        <div class="sidebar-footer">
            {{-- User info --}}
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px; padding:10px 12px; background:rgba(201,168,76,0.08); border-radius:6px; border:1px solid rgba(201,168,76,0.15);">
                <div style="width:32px; height:32px; background:linear-gradient(135deg,#C9A84C,#9A7B35); border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div style="flex:1; overflow:hidden;">
                    <div style="font-size:12px; font-weight:600; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::user()->name ?? '' }}</div>
                    <div style="font-size:9px; color:var(--gold); letter-spacing:1px; text-transform:uppercase; margin-top:1px;">{{ Auth::user()->role_label ?? 'Resepsionis' }}</div>
                </div>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%; display:flex; align-items:center; gap:8px; padding:9px 12px; background:transparent; border:1px solid rgba(220,38,38,0.3); border-radius:6px; color:rgba(220,38,38,0.7); font-size:11px; font-weight:600; letter-spacing:1px; text-transform:uppercase; cursor:pointer; font-family:var(--font-sans); transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(220,38,38,0.1)'; this.style.borderColor='rgba(220,38,38,0.5)'; this.style.color='#DC2626';"
                    onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(220,38,38,0.3)'; this.style.color='rgba(220,38,38,0.7)';">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>

            <p class="sidebar-footer-text" style="margin-top:12px;">© {{ date('Y') }} PPKD Jakarta Pusat</p>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- TOP BAR -->
        <header class="topbar">
            <div class="topbar-left">
                <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
                <span class="topbar-subtitle">@yield('page-subtitle', 'Hotel Management System')</span>
            </div>
            <div class="topbar-right">
                <span class="topbar-date" id="current-date"></span>
                @yield('topbar-actions')
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="page-content">

            @if(session('success'))
            <div class="alert alert-success">
                <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-error">
                <svg class="alert-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <strong>Terdapat kesalahan:</strong>
                    <ul style="margin-top:4px; padding-left:16px; font-size:12px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script>
    // Live date display
    function updateDate() {
        const el = document.getElementById('current-date');
        if (!el) return;
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        el.textContent = now.toLocaleDateString('id-ID', options);
    }
    updateDate();

    // Payment method toggle
    function initPaymentToggle() {
        const radios = document.querySelectorAll('input[name="payment_method"]');
        const ccPanel = document.getElementById('cc-panel');
        const btPanel = document.getElementById('bt-panel');
        if (!radios.length) return;
        radios.forEach(r => {
            r.addEventListener('change', function() {
                if (ccPanel) ccPanel.classList.toggle('active', this.value === 'credit_card');
                if (btPanel) btPanel.classList.toggle('active', this.value === 'bank_transfer');
            });
        });
        // Init state
        const checked = document.querySelector('input[name="payment_method"]:checked');
        if (checked) {
            if (ccPanel) ccPanel.classList.toggle('active', checked.value === 'credit_card');
            if (btPanel) btPanel.classList.toggle('active', checked.value === 'bank_transfer');
        }
    }
    document.addEventListener('DOMContentLoaded', initPaymentToggle);

    // Auto-calculate nights
    function calcNights() {
        const arrField = document.getElementById('arrival_date');
        const depField = document.getElementById('departure_date');
        const nightsField = document.getElementById('total_nights_display');
        if (!arrField || !depField || !nightsField) return;
        function update() {
            const a = new Date(arrField.value);
            const d = new Date(depField.value);
            if (!isNaN(a) && !isNaN(d) && d > a) {
                const diff = Math.round((d - a) / (1000*60*60*24));
                nightsField.textContent = diff + ' Malam';
            } else {
                nightsField.textContent = '—';
            }
        }
        arrField.addEventListener('change', update);
        depField.addEventListener('change', update);
        update();
    }
    document.addEventListener('DOMContentLoaded', calcNights);
</script>
@stack('scripts')
</body>
</html>
