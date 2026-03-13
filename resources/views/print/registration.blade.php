<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran — {{ $reservation->booking_number }}</title>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
</head>
<body>

<div class="print-actions">
    <button class="print-btn" onclick="window.print()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
        Cetak
    </button>
    <a href="{{ route('reservations.show', $reservation) }}" class="print-btn print-btn-back">
        ← Kembali
    </a>
</div>

<div class="print-page">

    <!-- HEADER -->
    <div style="text-align:center; margin-bottom:8mm; padding-bottom:5mm; border-bottom: 2px solid var(--gold);">
        <img src="{{ public_path('images/logo.png') }}" alt="PPKD" style="width:70px; height:70px; margin-bottom:8px;"
             onerror="this.style.display='none'">
        <div style="font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:600; color:#1C1C1E; letter-spacing:3px; text-transform:uppercase;">PPKD HOTEL</div>
        <div style="font-style:italic; font-size:11px; color:var(--gold); letter-spacing:2px; margin-top:2px;">Formulir Pendaftaran</div>
        <div style="font-size:10px; color:#888; letter-spacing:1px; font-style:italic;">Registration</div>
    </div>

    <!-- ROOM TOP TABLE -->
    <table style="width:100%; border-collapse:collapse; margin-bottom:4mm;">
        <tr>
            <td rowspan="2" style="border:1px solid var(--border); padding:8px 12px; width:25%; vertical-align:middle;">
                <div style="font-size:10px; font-weight:700; color:#1C1C1E;">Room No. {{ $reservation->room_number ?? '0601' }}</div>
                @if($reservation->no_of_rooms && $reservation->no_of_rooms > 1)
                <div style="font-size:10px; font-weight:700; color:#1C1C1E; margin-top:4px;">Room No. 0602</div>
                @endif
            </td>
            <td style="border:1px solid var(--border); padding:5px 10px;">
                <span style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; display:block;">Jumlah Tamu / No. of Person</span>
                <span style="font-size:11px; font-weight:600;">{{ $reservation->no_of_persons ?? '—' }}</span>
            </td>
            <td style="border:1px solid var(--border); padding:5px 10px;"></td>
            <td style="border:1px solid var(--border); padding:5px 10px;"></td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px;">
                <span style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; display:block;">Jumlah Kamar / No. of Room</span>
                <span style="font-size:11px; font-weight:600;">{{ $reservation->no_of_rooms ?? 1 }}</span>
            </td>
            <td style="border:1px solid var(--border); padding:5px 10px;">
                <span style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; display:block;">Jenis Kamar / Room Type</span>
                <span style="font-size:11px; font-weight:600;">{{ $reservation->room_type ?? '—' }}</span>
            </td>
            <td style="border:1px solid var(--border); padding:5px 10px;">
                <span style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; display:block;">Receptionist</span>
                <span style="font-size:11px; font-weight:600;">{{ $reservation->receptionist ?? '—' }}</span>
            </td>
        </tr>
    </table>

    <!-- CHECKOUT NOTICE -->
    <div class="checkout-banner">
        Check Out Time : <span>12.00 Noon</span>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Waktu Lapor Keluar : <span>Jam 12.00 Siang</span>
    </div>

    <!-- MAIN REGISTRATION TABLE -->
    <table style="width:100%; border-collapse:collapse; margin-top:3mm;">
        <tr>
            <td colspan="2" style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-style:italic; color:#666; width:70%;">
                Harap tulis dengan huruf cetak — <strong>Please print in block letters</strong>
            </td>
            <td rowspan="3" style="border:1px solid var(--border); padding:8px 12px; text-align:center; width:30%; vertical-align:top;">
                <div style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; margin-bottom:4px;">Waktu Kedatangan</div>
                <div style="font-size:9px; color:#888; margin-bottom:2px;">Arrival Time</div>
                <div style="font-size:14px; font-weight:700; color:#1C1C1E; margin-top:6px;">{{ $reservation->arrival_time ?? '14:00' }}</div>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; width:20%; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                Nama / <em>Name</em>
            </td>
            <td style="border:1px solid var(--border); padding:8px 12px; font-size:13px; font-weight:700; color:#1C1C1E; letter-spacing:1px; text-transform:uppercase;">
                {{ strtoupper($reservation->full_name) }}
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                Pekerjaan / <em>Profession</em>
            </td>
            <td style="border:1px solid var(--border); padding:8px 12px; font-size:12px; color:#1C1C1E;">
                {{ $reservation->profession ?? '—' }}
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                Perusahaan / <em>Company</em>
            </td>
            <td style="border:1px solid var(--border); padding:8px 12px; font-size:12px; color:#1C1C1E;">
                {{ $reservation->company ?? '—' }}
            </td>
            <td style="border:1px solid var(--border); padding:8px 12px; text-align:center; vertical-align:top;">
                <div style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; margin-bottom:4px;">Tanggal Kedatangan</div>
                <div style="font-size:9px; color:#888; margin-bottom:2px;">Arrival Date</div>
                <div style="font-size:12px; font-weight:700; color:#1C1C1E; margin-top:4px;">
                    {{ \Carbon\Carbon::parse($reservation->arrival_date)->format('d M Y') }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                Kebangsaan / <em>Nationality</em>
            </td>
            <td style="border:1px solid var(--border); padding:5px 10px;">
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <span>{{ $reservation->nationality ?? '—' }}</span>
                    <span style="font-size:9px; color:#888;">No. KTP: <strong>{{ $reservation->passport_no ?? '—' }}</strong></span>
                    <span style="font-size:9px; color:#888;">Birth: <strong>{{ $reservation->birth_date ? $reservation->birth_date->format('d/m/Y') : '—' }}</strong></span>
                </div>
            </td>
            <td rowspan="3" style="border:1px solid var(--border); padding:8px 12px; text-align:center; vertical-align:top;">
                <div style="font-size:8px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase; margin-bottom:4px;">Tgl Keberangkatan</div>
                <div style="font-size:9px; color:var(--gold); margin-bottom:2px;">Departure Date</div>
                <div style="font-size:12px; font-weight:700; color:#C9A84C; margin-top:4px;">
                    {{ \Carbon\Carbon::parse($reservation->departure_date)->format('d M Y') }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                Alamat / <em>Address</em>
            </td>
            <td style="border:1px solid var(--border); padding:8px 12px; font-size:11px; color:#1C1C1E;">
                <div>{{ $reservation->address ?? '—' }}</div>
                <div style="margin-top:4px; font-size:10px; color:#888;">
                    Tel: {{ $reservation->phone ?? '—' }} &nbsp;|&nbsp; HP: {{ $reservation->mobile_phone ?? '—' }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                Email
            </td>
            <td style="border:1px solid var(--border); padding:8px 12px; font-size:12px; color:#1C1C1E;">
                {{ $reservation->email ?? '—' }}
            </td>
        </tr>
        <tr>
            <td style="border:1px solid var(--border); padding:5px 10px; font-size:9px; font-weight:700; color:#888; letter-spacing:1px; text-transform:uppercase;">
                No. Member/
            </td>
            <td colspan="2" style="border:1px solid var(--border); padding:8px 12px; font-size:12px; color:#1C1C1E;">
                {{ $reservation->member_no ?? '—' }}
            </td>
        </tr>
        <!-- Signature row -->
        <tr>
            <td colspan="3" style="border:1px solid var(--border); height:50px; padding:8px 12px; vertical-align:bottom; font-size:9px; color:#aaa;">
                Tanda tangan / Signature
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border:1px solid var(--border); height:40px;"></td>
        </tr>
    </table>

    <!-- SAFETY DEPOSIT BOX -->
    <table class="deposit-table" style="margin-top:5mm;">
        <tr>
            <th style="width:40%;">Nomor Kotak Deposit / Safety Deposit Box Number</th>
            <th style="width:30%;">Dikeluarkan oleh / Issued</th>
            <th style="width:30%;">Tanggal / Date</th>
        </tr>
        <tr>
            <td style="font-size:12px; font-weight:600; color:#1C1C1E;">{{ $reservation->safety_deposit_box_no ?? '—' }}</td>
            <td style="font-size:12px; color:#1C1C1E;">{{ $reservation->issued_by ?? '—' }}</td>
            <td style="font-size:12px; color:#1C1C1E;">{{ $reservation->issued_date ? $reservation->issued_date->format('d M Y') : '—' }}</td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="print-footer" style="margin-top:6mm;">
        <div class="print-footer-text">PPKD Hotel Jakarta Pusat</div>
        <div class="gold-ornament">PPKD HOTEL</div>
        <div class="print-footer-text">{{ now()->format('d M Y H:i') }}</div>
    </div>

</div>
</body>
</html>
