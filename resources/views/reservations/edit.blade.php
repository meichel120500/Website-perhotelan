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
                    <select id="room_type_edit" name="room_type" class="form-control" onchange="autoFillRateEdit(this.value)">
                        <option value="">— Pilih —</option>
                        <option value="Standard"     data-price="500000"  {{ $reservation->room_type == 'Standard'     ? 'selected' : '' }}>Standard — Rp 500.000</option>
                        <option value="Deluxe"       data-price="1500000" {{ $reservation->room_type == 'Deluxe'       ? 'selected' : '' }}>Deluxe — Rp 1.500.000</option>
                        <option value="Suite"        data-price="4000000" {{ $reservation->room_type == 'Suite'        ? 'selected' : '' }}>Suite — Rp 4.000.000</option>
                        <option value="Executive"    data-price="5000000" {{ $reservation->room_type == 'Executive'    ? 'selected' : '' }}>Executive — Rp 5.000.000</option>
                        <option value="Presidential" data-price="7000000" {{ $reservation->room_type == 'Presidential' ? 'selected' : '' }}>Presidential — Rp 7.000.000</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tarif Kamar (Rp)</label>
                    <input type="number" id="room_rate_edit" name="room_rate_net" class="form-control"
                           value="{{ old('room_rate_net', $reservation->room_rate_net) }}"
                           placeholder="Otomatis terisi saat pilih tipe kamar"
                           style="background:#FFFDF8; border-color:rgba(201,168,76,0.4);">
                    <span class="form-hint">Terisi otomatis sesuai tipe kamar</span>
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

    <!-- ====== METODE PEMBAYARAN ====== -->
    <div class="card mb-24" style="margin-bottom:24px;">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Metode Pembayaran</div>
                    <div class="card-subtitle">Ubah metode pembayaran reservasi</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Radio Pilihan -->
            <div class="radio-group mb-16" style="margin-bottom:16px;">
                <label class="radio-label">
                    <input type="radio" name="payment_method" value="bank_transfer"
                           {{ old('payment_method', $reservation->payment_method) == 'bank_transfer' ? 'checked' : '' }}
                           onchange="togglePaymentEdit(this.value)">
                    Transfer Bank (Mandiri)
                </label>
                <label class="radio-label">
                    <input type="radio" name="payment_method" value="credit_card"
                           {{ old('payment_method', $reservation->payment_method) == 'credit_card' ? 'checked' : '' }}
                           onchange="togglePaymentEdit(this.value)">
                    Kartu Kredit
                </label>
            </div>

            <!-- Panel Bank Transfer -->
            <div class="payment-panel {{ old('payment_method', $reservation->payment_method) == 'bank_transfer' ? 'active' : '' }}" id="bt-panel-edit">
                <div class="form-section-title">Detail Transfer Bank</div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Mandiri Account No.</label>
                        <input type="text" name="mandiri_account" class="form-control"
                               placeholder="Nomor rekening Mandiri"
                               value="{{ old('mandiri_account', $reservation->mandiri_account) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mandiri Name Account</label>
                        <input type="text" name="mandiri_name_account" class="form-control"
                               placeholder="Nama pemilik rekening"
                               value="{{ old('mandiri_name_account', $reservation->mandiri_name_account) }}">
                    </div>
                </div>
            </div>

            <!-- Panel Kartu Kredit -->
            <div class="payment-panel {{ old('payment_method', $reservation->payment_method) == 'credit_card' ? 'active' : '' }}" id="cc-panel-edit">
                <div class="form-section-title">Detail Kartu Kredit</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nomor Kartu</label>
                        <input type="text" name="card_number" class="form-control"
                               placeholder="XXXX XXXX XXXX XXXX"
                               value="{{ old('card_number', $reservation->card_number) }}"
                               maxlength="19">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Pemegang Kartu</label>
                        <input type="text" name="card_holder_name" class="form-control"
                               placeholder="Nama di kartu"
                               value="{{ old('card_holder_name', $reservation->card_holder_name) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Kartu</label>
                        <select name="card_type" class="form-control">
                            <option value="">— Pilih —</option>
                            @foreach(['Visa','Mastercard','JCB','AMEX'] as $ct)
                            <option value="{{ $ct }}" {{ old('card_type', $reservation->card_type) == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Expired (MM/YY)</label>
                        <input type="text" name="card_expired" class="form-control"
                               placeholder="MM / YY" maxlength="7"
                               value="{{ old('card_expired', $reservation->card_expired) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SUBMIT -->
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
@push('scripts')
<script>
    // ===== AUTO FILL TARIF =====
    const roomPricesEdit = {
        'Standard':     500000,
        'Deluxe':       1500000,
        'Suite':        4000000,
        'Executive':    5000000,
        'Presidential': 7000000,
    };

    function autoFillRateEdit(roomType) {
        const rateField = document.getElementById('room_rate_edit');
        if (roomPricesEdit[roomType]) {
            rateField.value = roomPricesEdit[roomType];
            // Animasi highlight gold
            rateField.style.transition = 'all 0.3s';
            rateField.style.borderColor = '#C9A84C';
            rateField.style.boxShadow = '0 0 0 3px rgba(201,168,76,0.25)';
            setTimeout(() => {
                rateField.style.boxShadow = '';
            }, 1500);
        } else {
            rateField.value = '';
        }
    }
    // ===== TOGGLE PAYMENT PANEL =====
    function togglePaymentEdit(method) {
        const btPanel = document.getElementById('bt-panel-edit');
        const ccPanel = document.getElementById('cc-panel-edit');
        if (method === 'bank_transfer') {
            btPanel.classList.add('active');
            ccPanel.classList.remove('active');
        } else {
            ccPanel.classList.add('active');
            btPanel.classList.remove('active');
        }
    }
</script>
@endpush

@endsection