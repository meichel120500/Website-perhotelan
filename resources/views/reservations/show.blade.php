@extends('layouts.app')

@section('title', 'Detail Reservasi — ' . $reservation->booking_number)
@section('page-title', 'Detail Reservasi')
@section('page-subtitle', $reservation->booking_number)

@section('topbar-actions')
    <div class="btn-group">
        <!-- Quick Status Buttons -->
        @php
            $nextStatus = [
                'pending'     => ['status' => 'confirmed',   'label' => 'Konfirmasi',  'class' => 'btn-gold'],
                'confirmed'   => ['status' => 'checked_in',  'label' => 'Check-In',    'class' => 'btn-gold'],
                'checked_in'  => ['status' => 'checked_out', 'label' => 'Check-Out',   'class' => 'btn-dark'],
                'checked_out' => null,
                'cancelled'   => null,
            ];
            $next = $nextStatus[$reservation->status] ?? null;
        @endphp

        @if($next)
        <form method="POST" action="{{ route('reservations.status', $reservation) }}" style="display:inline;">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="{{ $next['status'] }}">
            <button type="submit" class="btn {{ $next['class'] }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="width:15px;height:15px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ $next['label'] }}
            </button>
        </form>
        @endif

        @if(!in_array($reservation->status, ['cancelled', 'checked_out']))
        <form method="POST" action="{{ route('reservations.status', $reservation) }}" style="display:inline;"
              onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
            @csrf @method('PATCH')
            <input type="hidden" name="status" value="cancelled">
            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
        </form>
        @endif

        <a href="{{ route('reservations.print-registration', $reservation) }}" class="btn btn-outline" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Form Registrasi
        </a>
        <a href="{{ route('reservations.print', $reservation) }}" class="btn btn-dark" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Reservation Confirmation
        </a>
        <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-gold">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit
        </a>
    </div>
@endsection

@section('content')

<!-- STATUS TIMELINE -->
<div class="card mb-24" style="margin-bottom:24px;">
    <div class="card-body" style="padding: 24px 32px;">
        <div style="font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--text-soft); margin-bottom:20px;">Alur Status Reservasi</div>
        <div style="display:flex; align-items:center; gap:0; flex-wrap:nowrap; overflow-x:auto; padding-bottom:4px;">
            @php
                $steps = [
                    ['key' => 'pending',     'label' => 'Pending',    'desc' => 'Baru masuk',        'icon' => '📋'],
                    ['key' => 'confirmed',   'label' => 'Confirmed',  'desc' => 'Dikonfirmasi',      'icon' => '✅'],
                    ['key' => 'checked_in',  'label' => 'Check-In',   'desc' => 'Tamu tiba',         'icon' => '🏨'],
                    ['key' => 'checked_out', 'label' => 'Check-Out',  'desc' => 'Tamu pulang',       'icon' => '👋'],
                ];
                $order = ['pending' => 0, 'confirmed' => 1, 'checked_in' => 2, 'checked_out' => 3];
                $currentOrder = $order[$reservation->status] ?? -1;
            @endphp

            @foreach($steps as $i => $step)
                @php
                    $stepOrder = $order[$step['key']];
                    $isDone    = $currentOrder > $stepOrder;
                    $isActive  = $reservation->status === $step['key'];
                    $isPending = $currentOrder < $stepOrder;
                @endphp

                <!-- Step -->
                <div style="display:flex; flex-direction:column; align-items:center; min-width:100px; position:relative; z-index:1;">
                    <div style="
                        width: 44px; height: 44px;
                        border-radius: 50%;
                        display: flex; align-items: center; justify-content: center;
                        font-size: {{ $isActive ? '20px' : '16px' }};
                        background: {{ $isDone ? 'linear-gradient(135deg, #C9A84C, #9A7B35)' : ($isActive ? 'linear-gradient(135deg, #C9A84C, #9A7B35)' : '#EDE6D8') }};
                        border: {{ $isActive ? '3px solid #C9A84C' : '2px solid '.($isDone ? '#C9A84C' : '#D5C9B1') }};
                        box-shadow: {{ $isActive ? '0 0 0 4px rgba(201,168,76,0.2)' : 'none' }};
                        transition: all 0.3s;
                    ">
                        @if($isDone)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="3" style="width:20px;height:20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <span>{{ $step['icon'] }}</span>
                        @endif
                    </div>
                    <div style="margin-top:8px; font-size:11px; font-weight:{{ $isActive ? '700' : '500' }}; color:{{ $isActive ? 'var(--gold)' : ($isDone ? 'var(--charcoal)' : 'var(--text-soft)') }}; text-align:center; white-space:nowrap;">
                        {{ $step['label'] }}
                    </div>
                    <div style="font-size:9px; color:var(--text-soft); text-align:center; margin-top:2px;">
                        {{ $step['desc'] }}
                    </div>
                </div>

                <!-- Connector line (not after last) -->
                @if(!$loop->last)
                <div style="
                    flex: 1;
                    height: 3px;
                    min-width: 30px;
                    margin-bottom: 28px;
                    background: {{ $currentOrder > $stepOrder ? 'linear-gradient(90deg, #C9A84C, #C9A84C)' : '#EDE6D8' }};
                    border-radius: 2px;
                    transition: all 0.3s;
                "></div>
                @endif
            @endforeach

            @if($reservation->status === 'cancelled')
            <div style="margin-left:16px; margin-bottom:28px;">
                <div style="
                    padding: 8px 16px;
                    background: rgba(220,38,38,0.1);
                    border: 1px solid rgba(220,38,38,0.3);
                    border-radius: 20px;
                    font-size:11px; font-weight:700;
                    color:#DC2626; white-space:nowrap;
                ">❌ Dibatalkan</div>
            </div>
            @endif
        </div>

        <!-- Quick status change form -->
        @if(!in_array($reservation->status, ['checked_out', 'cancelled']))
        <div style="margin-top:20px; padding-top:16px; border-top:1px solid var(--cream-dark); display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
            <span style="font-size:11px; color:var(--text-soft); font-weight:600; letter-spacing:1px; text-transform:uppercase;">Ubah Status:</span>
            @php
                $allStatuses = [
                    'pending'     => 'Pending',
                    'confirmed'   => 'Confirmed',
                    'checked_in'  => 'Check-In',
                    'checked_out' => 'Check-Out',
                    'cancelled'   => 'Cancelled',
                ];
            @endphp
            @foreach($allStatuses as $val => $lbl)
                @if($val !== $reservation->status)
                <form method="POST" action="{{ route('reservations.status', $reservation) }}" style="display:inline;"
                      @if($val === 'cancelled') onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')" @endif>
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="{{ $val }}">
                    <button type="submit" style="
                        padding: 6px 16px;
                        border-radius: 20px;
                        font-size: 11px;
                        font-weight: 600;
                        letter-spacing: 0.5px;
                        cursor: pointer;
                        border: 1px solid {{ $val === 'cancelled' ? '#DC2626' : 'var(--gold)' }};
                        background: transparent;
                        color: {{ $val === 'cancelled' ? '#DC2626' : 'var(--gold)' }};
                        transition: all 0.2s;
                        font-family: var(--font-sans);
                    "
                    onmouseover="this.style.background='{{ $val === 'cancelled' ? '#DC2626' : 'var(--gold)' }}'; this.style.color='white';"
                    onmouseout="this.style.background='transparent'; this.style.color='{{ $val === 'cancelled' ? '#DC2626' : 'var(--gold)' }}';">
                        → {{ $lbl }}
                    </button>
                </form>
                @endif
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- Booking header -->

<div style="display:flex; gap:20px; margin-bottom:24px; flex-wrap:wrap;">
    <div class="card" style="flex:1; min-width:200px;">
        <div class="card-body" style="text-align:center; padding:24px 20px;">
            <div style="font-size:9px; letter-spacing:2px; text-transform:uppercase; color:var(--text-soft); margin-bottom:6px;">Nomor Booking</div>
            <div style="font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:600; color:var(--gold);">{{ $reservation->booking_number }}</div>
        </div>
    </div>
    <div class="card" style="flex:1; min-width:200px;">
        <div class="card-body" style="text-align:center; padding:24px 20px;">
            <div style="font-size:9px; letter-spacing:2px; text-transform:uppercase; color:var(--text-soft); margin-bottom:6px;">Status</div>
            @php $labels = ['pending'=>'Pending','confirmed'=>'Confirmed','checked_in'=>'Check-In','checked_out'=>'Check-Out','cancelled'=>'Cancelled'];
                 $badges = ['pending'=>'badge-pending','confirmed'=>'badge-confirmed','checked_in'=>'badge-checked-in','checked_out'=>'badge-checked-out','cancelled'=>'badge-cancelled']; @endphp
            <span class="badge {{ $badges[$reservation->status] ?? '' }}" style="font-size:13px; padding:8px 20px;">{{ $labels[$reservation->status] ?? $reservation->status }}</span>
        </div>
    </div>
    <div class="card" style="flex:1; min-width:200px;">
        <div class="card-body" style="text-align:center; padding:24px 20px;">
            <div style="font-size:9px; letter-spacing:2px; text-transform:uppercase; color:var(--text-soft); margin-bottom:6px;">Durasi</div>
            <div style="font-family:'Cormorant Garamond',serif; font-size:28px; font-weight:600; color:var(--charcoal);">{{ $reservation->total_nights ?? '—' }}</div>
            <div style="font-size:11px; color:var(--text-soft);">Malam</div>
        </div>
    </div>
    <div class="card" style="flex:1; min-width:200px;">
        <div class="card-body" style="text-align:center; padding:24px 20px;">
            <div style="font-size:9px; letter-spacing:2px; text-transform:uppercase; color:var(--text-soft); margin-bottom:6px;">Kamar</div>
            <div style="font-family:'Cormorant Garamond',serif; font-size:28px; font-weight:600; color:var(--charcoal);">{{ $reservation->room_number ?? '—' }}</div>
            <div style="font-size:11px; color:var(--text-soft);">{{ $reservation->room_type ?? '—' }}</div>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">
    <!-- Guest Info -->
    <div class="card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
                <div class="card-title">Data Tamu</div>
            </div>
        </div>
        <div class="card-body" style="padding: 24px;">
            @php
            $rows = [
                ['Nama Lengkap', $reservation->full_name],
                ['Pekerjaan', $reservation->profession],
                ['Perusahaan', $reservation->company],
                ['Kewarganegaraan', $reservation->nationality],
                ['No. KTP / Paspor', $reservation->passport_no],
                ['Tanggal Lahir', $reservation->birth_date ? $reservation->birth_date->format('d M Y') : null],
                ['Alamat', $reservation->address],
                ['Telepon', $reservation->phone],
                ['Handphone', $reservation->mobile_phone],
                ['Email', $reservation->email],
                ['No. Member', $reservation->member_no],
            ];
            @endphp
            <table style="width:100%; border-collapse:collapse;">
                @foreach($rows as [$label, $value])
                @if($value)
                <tr>
                    <td style="padding:8px 0; width:40%; font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-soft); vertical-align:top;">{{ $label }}</td>
                    <td style="padding:8px 0; font-size:13px; color:var(--text-dark); vertical-align:top;">{{ $value }}</td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>
    </div>

    <!-- Stay Info -->
    <div style="display:flex; flex-direction:column; gap:24px;">
        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                    <div class="card-title">Informasi Menginap</div>
                </div>
            </div>
            <div class="card-body" style="padding:24px;">
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="padding:8px 0; font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-soft); width:40%;">Arrival</td>
                        <td style="padding:8px 0; font-size:13px; color:var(--text-dark);">{{ \Carbon\Carbon::parse($reservation->arrival_date)->format('d M Y') }} {{ $reservation->arrival_time ? '— '.$reservation->arrival_time : '' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0; font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-soft);">Departure</td>
                        <td style="padding:8px 0; font-size:13px; color:var(--text-dark);">{{ \Carbon\Carbon::parse($reservation->departure_date)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0; font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-soft);">Tamu</td>
                        <td style="padding:8px 0; font-size:13px; color:var(--text-dark);">{{ $reservation->no_of_persons ?? 1 }} orang, {{ $reservation->no_of_rooms ?? 1 }} kamar</td>
                    </tr>
                    @if($reservation->room_rate_net)
                    <tr>
                        <td style="padding:8px 0; font-size:10px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-soft);">Tarif</td>
                        <td style="padding:8px 0; font-size:14px; color:var(--gold); font-weight:700; font-family:'Cormorant Garamond',serif;">Rp {{ number_format($reservation->room_rate_net, 0, ',', '.') }} / malam</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-header-left">
                    <div class="card-header-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg></div>
                    <div class="card-title">Pembayaran</div>
                </div>
            </div>
            <div class="card-body" style="padding:24px;">
                <div style="font-size:13px; color:var(--text-dark); margin-bottom:8px;">
                    <strong>{{ $reservation->payment_method == 'credit_card' ? 'Kartu Kredit' : 'Transfer Bank (Mandiri)' }}</strong>
                </div>
                @if($reservation->payment_method == 'credit_card' && $reservation->card_holder_name)
                <div style="font-size:12px; color:var(--text-soft);">{{ $reservation->card_holder_name }} — {{ $reservation->card_type }}</div>
                @endif
                @if($reservation->payment_method == 'bank_transfer' && $reservation->mandiri_account)
                <div style="font-size:12px; color:var(--text-soft);">Rekening: {{ $reservation->mandiri_account }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete form -->
<div class="card mt-24" style="margin-top:24px;">
    <div class="card-body" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div style="font-size:12px; color:var(--text-soft);">Dibuat pada: {{ $reservation->created_at->format('d M Y, H:i') }}</div>
        <form method="POST" action="{{ route('reservations.destroy', $reservation) }}"
              onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Hapus Reservasi
            </button>
        </form>
    </div>
</div>

@endsection
