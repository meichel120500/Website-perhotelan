@extends('layouts.app')

@section('title', 'Edit Reservasi')
@section('page-title', 'Edit Reservasi')
@section('page-subtitle', $reservation->booking_number)

@section('topbar-actions')
    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-outline">← Kembali</a>
@endsection

@section('content')
<form action="{{ route('reservations.update', $reservation) }}" method="POST">
    @csrf @method('PUT')

    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <div class="card-title">Edit Reservasi</div>
                    <div class="card-subtitle">{{ $reservation->booking_number }}</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Depan <span class="required">*</span></label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $reservation->first_name) }}" required style="text-transform:uppercase;">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $reservation->last_name) }}" style="text-transform:uppercase;">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        @foreach(['pending'=>'Pending','confirmed'=>'Confirmed','checked_in'=>'Check-In','checked_out'=>'Check-Out','cancelled'=>'Cancelled'] as $val => $label)
                        <option value="{{ $val }}" {{ $reservation->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Kamar</label>
                    <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $reservation->room_number) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Tipe Kamar</label>
                    <select name="room_type" class="form-control">
                        <option value="">— Pilih —</option>
                        @foreach(['Standard','Deluxe','Suite','Executive','Presidential'] as $type)
                        <option value="{{ $type }}" {{ $reservation->room_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tarif (Rp)</label>
                    <input type="number" name="room_rate_net" class="form-control" value="{{ old('room_rate_net', $reservation->room_rate_net) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Arrival Date <span class="required">*</span></label>
                    <input type="date" name="arrival_date" class="form-control" value="{{ old('arrival_date', $reservation->arrival_date?->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Departure Date <span class="required">*</span></label>
                    <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $reservation->departure_date?->format('Y-m-d')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $reservation->email) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $reservation->phone) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Perusahaan</label>
                    <input type="text" name="company" class="form-control" value="{{ old('company', $reservation->company) }}">
                </div>
                <div class="form-group col-span-2">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" class="form-control" rows="3">{{ old('notes', $reservation->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body" style="display:flex; justify-content:flex-end; gap:12px;">
            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-gold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </div>
</form>
@endsection
