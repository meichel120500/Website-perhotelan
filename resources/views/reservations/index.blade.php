@extends('layouts.app')

@section('title', 'Data Reservasi')
@section('page-title', 'Data Reservasi')
@section('page-subtitle', 'Kelola semua data reservasi tamu hotel')

@section('topbar-actions')
    <a href="{{ route('reservations.create') }}" class="btn btn-gold">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Reservasi Baru
    </a>
@endsection

@section('content')

<!-- STATS -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Reservasi</div>
        <div class="stat-value">{{ $reservations->total() }}</div>
        <div class="stat-sub">Semua waktu</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Check-In Hari Ini</div>
        <div class="stat-value">{{ $reservations->where('status','checked_in')->count() }}</div>
        <div class="stat-sub">Tamu aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Pending</div>
        <div class="stat-value">{{ $reservations->where('status','pending')->count() }}</div>
        <div class="stat-sub">Menunggu konfirmasi</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Confirmed</div>
        <div class="stat-value">{{ $reservations->where('status','confirmed')->count() }}</div>
        <div class="stat-sub">Siap check-in</div>
    </div>
</div>

<!-- TABLE CARD -->
<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <div class="card-header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <div class="card-title">Daftar Reservasi</div>
                <div class="card-subtitle">{{ $reservations->total() }} total data</div>
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No. Booking</th>
                    <th>Nama Tamu</th>
                    <th>Kamar</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Malam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $res)
                <tr>
                    <td>
                        <span style="font-family: 'Courier New', monospace; font-size:11px; color: var(--gold); font-weight:700;">
                            {{ $res->booking_number }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight:600; font-size:13px;">{{ $res->full_name }}</div>
                        @if($res->company)
                        <div style="font-size:11px; color:var(--text-soft);">{{ $res->company }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;">{{ $res->room_number ?? '—' }}</div>
                        @if($res->room_type)
                        <div style="font-size:11px; color:var(--text-soft);">{{ $res->room_type }}</div>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($res->arrival_date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($res->departure_date)->format('d M Y') }}</td>
                    <td style="text-align:center; font-weight:600;">{{ $res->total_nights ?? '—' }}</td>
                    <td>
                        @php
                            $badges = [
                                'pending'     => 'badge-pending',
                                'confirmed'   => 'badge-confirmed',
                                'checked_in'  => 'badge-checked-in',
                                'checked_out' => 'badge-checked-out',
                                'cancelled'   => 'badge-cancelled',
                            ];
                            $labels = [
                                'pending'     => 'Pending',
                                'confirmed'   => 'Confirmed',
                                'checked_in'  => 'Check-In',
                                'checked_out' => 'Check-Out',
                                'cancelled'   => 'Cancelled',
                            ];
                        @endphp
                        <span class="badge {{ $badges[$res->status] ?? '' }}">
                            {{ $labels[$res->status] ?? $res->status }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('reservations.show', $res) }}" class="btn btn-outline btn-sm">Detail</a>
                            @php
                                $quickNext = [
                                    'pending'   => ['status' => 'confirmed',  'label' => 'Konfirmasi'],
                                    'confirmed' => ['status' => 'checked_in', 'label' => 'Check-In'],
                                    'checked_in'=> ['status' => 'checked_out','label' => 'Check-Out'],
                                ];
                                $qn = $quickNext[$res->status] ?? null;
                            @endphp
                            @if($qn)
                            <form method="POST" action="{{ route('reservations.status', $res) }}" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="{{ $qn['status'] }}">
                                <button type="submit" class="btn btn-gold btn-sm">{{ $qn['label'] }}</button>
                            </form>
                            @endif
                            <a href="{{ route('reservations.print', $res) }}" class="btn btn-dark btn-sm" target="_blank">Cetak</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 48px; color:var(--text-soft);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="width:48px;height:48px;margin:0 auto 12px;display:block;color:var(--cream-dark);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p>Belum ada data reservasi</p>
                        <a href="{{ route('reservations.create') }}" class="btn btn-gold" style="margin-top:16px;">Buat Reservasi Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reservations->hasPages())
    <div style="padding: 20px 32px; border-top: var(--border-light); display:flex; justify-content:flex-end;">
        {{ $reservations->links() }}
    </div>
    @endif
</div>

@endsection
