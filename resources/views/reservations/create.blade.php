@extends('layouts.app')

@section('title', 'Reservasi Baru')
@section('page-title', 'Formulir Reservasi')
@section('page-subtitle', 'Isi data tamu dan detail penginapan')

@section('topbar-actions')
    <a href="{{ route('reservations.index') }}" class="btn btn-outline">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
@endsection

@section('content')
<form action="{{ route('reservations.store') }}" method="POST" id="reservation-form">
    @csrf

    <!-- ====== ROOM INFO ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Informasi Kamar</div>
                    <div class="card-subtitle">PPKD Hotel — Jakarta Pusat</div>
                </div>
            </div>
            <div style="text-align:right; font-size:11px; color:var(--text-soft);">
                <div>Check-In: <strong>14:00</strong></div>
                <div>Check-Out: <strong>12:00</strong></div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="room_number">Nomor Kamar</label>
                    <input type="text" id="room_number" name="room_number"
                           class="form-control" placeholder="cth: 0601, 0602"
                           value="{{ old('room_number') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="room_type">Tipe Kamar <span class="required">*</span></label>
                    <select id="room_type" name="room_type" class="form-control">
                        <option value="">— Pilih Tipe —</option>
                        <option value="Standard" {{ old('room_type')=='Standard'?'selected':'' }}>Standard</option>
                        <option value="Deluxe" {{ old('room_type')=='Deluxe'?'selected':'' }}>Deluxe</option>
                        <option value="Suite" {{ old('room_type')=='Suite'?'selected':'' }}>Suite</option>
                        <option value="Executive" {{ old('room_type')=='Executive'?'selected':'' }}>Executive</option>
                        <option value="Presidential" {{ old('room_type')=='Presidential'?'selected':'' }}>Presidential</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="no_of_persons">Jumlah Tamu</label>
                    <input type="number" id="no_of_persons" name="no_of_persons"
                           class="form-control" min="1" placeholder="1"
                           value="{{ old('no_of_persons', 1) }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="no_of_rooms">Jumlah Kamar</label>
                    <input type="number" id="no_of_rooms" name="no_of_rooms"
                           class="form-control" min="1" placeholder="1"
                           value="{{ old('no_of_rooms', 1) }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="room_rate_net">Tarif Kamar (Rp)</label>
                    <input type="number" id="room_rate_net" name="room_rate_net"
                           class="form-control" placeholder="0"
                           value="{{ old('room_rate_net') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="receptionist">Resepsionis</label>
                    <input type="text" id="receptionist" name="receptionist"
                           class="form-control" placeholder="Nama resepsionis"
                           value="{{ old('receptionist') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- ====== STAY INFO ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Tanggal Menginap</div>
                    <div class="card-subtitle">Arrival & Departure Information</div>
                </div>
            </div>
            <div style="font-size:13px; color:var(--text-mid);">
                Durasi: <strong id="total_nights_display" style="color:var(--gold);">—</strong>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="arrival_date">Tanggal Kedatangan <span class="required">*</span></label>
                    <input type="date" id="arrival_date" name="arrival_date"
                           class="form-control"
                           value="{{ old('arrival_date') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="arrival_time">Waktu Kedatangan</label>
                    <input type="time" id="arrival_time" name="arrival_time"
                           class="form-control" value="{{ old('arrival_time', '14:00') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="departure_date">Tanggal Keberangkatan <span class="required">*</span></label>
                    <input type="date" id="departure_date" name="departure_date"
                           class="form-control"
                           value="{{ old('departure_date') }}" required>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== GUEST INFO ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Data Tamu</div>
                    <div class="card-subtitle">Informasi Identitas Tamu — Harap isi dengan huruf cetak</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-section">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="first_name">Nama Depan <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               placeholder="NAMA DEPAN" value="{{ old('first_name') }}"
                               required style="text-transform:uppercase;">
                        @error('first_name')
                        <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name"
                               class="form-control" placeholder="NAMA BELAKANG"
                               value="{{ old('last_name') }}" style="text-transform:uppercase;">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="birth_date">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date"
                               class="form-control" value="{{ old('birth_date') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nationality">Kewarganegaraan</label>
                        <input type="text" id="nationality" name="nationality"
                               class="form-control" placeholder="cth: WNI / Indonesian"
                               value="{{ old('nationality') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="passport_no">No. KTP / Paspor</label>
                        <input type="text" id="passport_no" name="passport_no"
                               class="form-control" placeholder="Nomor identitas"
                               value="{{ old('passport_no') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="member_no">No. Member</label>
                        <input type="text" id="member_no" name="member_no"
                               class="form-control" placeholder="Nomor member (opsional)"
                               value="{{ old('member_no') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="profession">Pekerjaan</label>
                        <input type="text" id="profession" name="profession"
                               class="form-control" placeholder="Profesi / jabatan"
                               value="{{ old('profession') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="company">Perusahaan / Instansi</label>
                        <input type="text" id="company" name="company"
                               class="form-control" placeholder="Nama perusahaan"
                               value="{{ old('company') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email"
                               class="form-control" placeholder="email@contoh.com"
                               value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Telepon</label>
                        <input type="text" id="phone" name="phone"
                               class="form-control" placeholder="cth: 021-xxxxxxxx"
                               value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="mobile_phone">Handphone</label>
                        <input type="text" id="mobile_phone" name="mobile_phone"
                               class="form-control" placeholder="cth: 08xx-xxxx-xxxx"
                               value="{{ old('mobile_phone') }}">
                    </div>
                    <div class="form-group col-span-2">
                        <label class="form-label" for="address">Alamat</label>
                        <textarea id="address" name="address" class="form-control"
                                  placeholder="Alamat lengkap tamu" rows="3">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== BOOKING INFO ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Informasi Pemesanan</div>
                    <div class="card-subtitle">Company / Agent & Contact Details</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="company_agent">Company / Agent</label>
                    <input type="text" id="company_agent" name="company_agent"
                           class="form-control" placeholder="Nama perusahaan / agen"
                           value="{{ old('company_agent') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="book_by">Dipesan Oleh</label>
                    <input type="text" id="book_by" name="book_by"
                           class="form-control" placeholder="Nama pemesan"
                           value="{{ old('book_by') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="person_pax">Person Pax</label>
                    <input type="number" id="person_pax" name="person_pax"
                           class="form-control" min="1" placeholder="1"
                           value="{{ old('person_pax') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="agent_phone">Telepon Agent</label>
                    <input type="text" id="agent_phone" name="agent_phone"
                           class="form-control" placeholder="No. telepon"
                           value="{{ old('agent_phone') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="agent_fax">Fax</label>
                    <input type="text" id="agent_fax" name="agent_fax"
                           class="form-control" placeholder="No. fax"
                           value="{{ old('agent_fax') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="agent_email">Email Agent</label>
                    <input type="email" id="agent_email" name="agent_email"
                           class="form-control" placeholder="email agent"
                           value="{{ old('agent_email') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- ====== PAYMENT ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Metode Pembayaran</div>
                    <div class="card-subtitle">Pilih metode pembayaran yang digunakan</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="radio-group mb-16">
                <label class="radio-label">
                    <input type="radio" name="payment_method" value="bank_transfer"
                           {{ old('payment_method','bank_transfer')=='bank_transfer'?'checked':'' }}>
                    Transfer Bank (Mandiri)
                </label>
                <label class="radio-label">
                    <input type="radio" name="payment_method" value="credit_card"
                           {{ old('payment_method')=='credit_card'?'checked':'' }}>
                    Kartu Kredit
                </label>
            </div>

            <!-- Bank Transfer Panel -->
            <div class="payment-panel {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'active' : '' }}" id="bt-panel">
                <div class="form-section-title">Detail Transfer Bank</div>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label">Mandiri Account No.</label>
                        <input type="text" name="mandiri_account" class="form-control"
                               placeholder="Nomor rekening Mandiri"
                               value="{{ old('mandiri_account') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mandiri Name Account</label>
                        <input type="text" name="mandiri_name_account" class="form-control"
                               placeholder="Nama pemilik rekening"
                               value="{{ old('mandiri_name_account') }}">
                    </div>
                </div>
            </div>

            <!-- Credit Card Panel -->
            <div class="payment-panel {{ old('payment_method') == 'credit_card' ? 'active' : '' }}" id="cc-panel">
                <div class="form-section-title">Detail Kartu Kredit</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nomor Kartu</label>
                        <input type="text" name="card_number" class="form-control"
                               placeholder="XXXX XXXX XXXX XXXX"
                               value="{{ old('card_number') }}"
                               maxlength="19">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Pemegang Kartu</label>
                        <input type="text" name="card_holder_name" class="form-control"
                               placeholder="Nama di kartu"
                               value="{{ old('card_holder_name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Kartu</label>
                        <select name="card_type" class="form-control">
                            <option value="">— Pilih —</option>
                            <option value="Visa">Visa</option>
                            <option value="Mastercard">Mastercard</option>
                            <option value="JCB">JCB</option>
                            <option value="AMEX">American Express</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Expired (MM/YY)</label>
                        <input type="text" name="card_expired" class="form-control"
                               placeholder="MM / YY" maxlength="7"
                               value="{{ old('card_expired') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== SAFETY DEPOSIT BOX ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Safety Deposit Box</div>
                    <div class="card-subtitle">Nomor Kotak Deposit</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="safety_deposit_box_no">No. Safety Deposit Box</label>
                    <input type="text" id="safety_deposit_box_no" name="safety_deposit_box_no"
                           class="form-control" placeholder="Nomor kotak deposit"
                           value="{{ old('safety_deposit_box_no') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="issued_by">Dikeluarkan Oleh</label>
                    <input type="text" id="issued_by" name="issued_by"
                           class="form-control" placeholder="Nama staf"
                           value="{{ old('issued_by') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="issued_date">Tanggal Dikeluarkan</label>
                    <input type="date" id="issued_date" name="issued_date"
                           class="form-control" value="{{ old('issued_date') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- ====== NOTES ====== -->
    <div class="card mb-24">
        <div class="card-header">
            <div class="card-header-left">
                <div class="card-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <div class="card-title">Catatan Tambahan</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <textarea name="notes" class="form-control" rows="4"
                          placeholder="Catatan khusus atau permintaan tamu...">{{ old('notes') }}</textarea>
            </div>
        </div>
    </div>

    <!-- ====== SUBMIT ====== -->
    <div class="card">
        <div class="card-body" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div style="font-size:12px; color:var(--text-soft);">
                <span style="color:var(--gold);">*</span> Kolom wajib diisi
            </div>
            <div class="btn-group">
                <a href="{{ route('reservations.index') }}" class="btn btn-outline">
                    Batal
                </a>
                <button type="submit" class="btn btn-gold btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Reservasi
                </button>
            </div>
        </div>
    </div>

</form>
@endsection
