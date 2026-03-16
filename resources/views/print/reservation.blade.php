<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation — {{ $reservation->booking_number }}</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;1,400&display=swap');

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 13.5px; /* Ukuran ideal: Tidak sekecil 12px, tidak sebesar 16px */
        color: #000;
        line-height: 1.3;
        background: white;
    }

    .rc-page {
        width: 210mm;
        height: 297mm; /* Kunci agar tetap A4 */
        margin: 0 auto;
        padding: 10mm 15mm; /* Margin dikurangi agar muat 1 lembar */
    }

    /* HEADER - Dibuat lebih ringkas */
    .rc-header {
        text-align: center;
        margin-bottom: 3mm;
    }
    .rc-logo {
        width: 65px; 
        height: 65px;
        margin: 0 auto 3px;
    }
    .rc-hotel-name {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .rc-doc-title {
        font-size: 15px;
        font-weight: bold;
        margin: 3mm 0 1mm;
    }

    hr.solid { border: none; border-top: 1.5px solid #000; margin: 2mm 0; }

    /* TO ROW */
    .to-row {
        display: flex;
        margin: 3mm 0;
        font-size: 15px;
        font-weight: bold;
    }
    .to-row .val {
        flex: 1;
        border-bottom: 1px solid #000;
        margin-left: 5px;
        padding-left: 5px;
    }

    /* GRID & ROWS - Dioptimalkan spasinya */
    .two-col {
        display: grid;
        grid-template-columns: 55% 45%;
        margin-bottom: 2mm;
    }

    .frow, .drow {
        display: flex;
        margin-bottom: 2px;
        font-size: 13px;
    }
    
    .frow .lbl { min-width: 120px; }
    .frow .lbl-sm { min-width: 50px; }
    .drow .lbl { min-width: 150px; }
    .frow .val, .drow .val { font-weight: bold; }

    /* NOTICE & POLICY - Font sedikit diperkecil agar hemat ruang */
    .notice {
        font-size: 11.5px;
        margin: 2mm 0;
        text-align: justify;
    }

    .pay-title, .cancel-title { 
        font-size: 13px; 
        font-weight: bold; 
        margin-top: 2mm;
    }

    .cancel-list { padding-left: 15px; }
    .cancel-list li {
        font-size: 11.5px;
        margin-bottom: 1px;
    }

    /* SIGNATURE AREA - Dibuat lebih naik agar tidak tumpah ke lembar ke-2 */
    .sig-container {
        margin-top: 10mm;
        display: flex;
        justify-content: flex-end;
    }
    .sig-box {
        width: 200px;
        text-align: center;
    }
    .sig-name {
        border-top: 1px solid #000;
        padding-top: 4px;
        font-weight: bold;
        font-size: 13px;
    }

    @media screen {
        body { background: #e0e0e0; }
        .rc-page {
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 20px auto;
        }
        .actions { position: fixed; top: 20px; right: 20px; display: flex; gap: 10px; }
        .btn-print { padding: 10px 20px; background: #C9A84C; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;}
    }

    @media print {
        .actions { display: none !important; }
        .rc-page { margin: 0; padding: 5mm 10mm; width: 100%; }
        @page { size: A4; margin: 0; }
    }
</style>
</head>

<body>

    <div class="actions">
        <button class="btn-print" onclick="window.print()">🖨 Cetak</button>
        <a href="{{ route('reservations.show', $reservation) }}" class="btn-print btn-back">← Kembali</a>
    </div>

    <div class="rc-page">

        {{-- ====== HEADER ====== --}}
        <div class="rc-header">
            <img src="{{ asset('images/logo.jpeg') }}" alt="PPKD" class="rc-logo"
                onerror="this.style.display='none'">
            <div class="rc-hotel-name">PPKD HOTEL</div>
        </div>

        {{-- ====== JUDUL ====== --}}
        <div class="rc-doc-title">Reservation Confirmation</div>
        <hr class="solid">

        {{-- ====== TO ====== --}}
        <div class="to-row">
            <span class="lbl">To.</span>
            <span class="colon">:</span>
            <span class="val">{{ $reservation->full_name }}</span>
        </div>

        {{-- ====== DUA KOLOM ====== --}}
        <div class="two-col">
            {{-- Kiri --}}
            <div class="col-left">
                <div class="frow">
                    <span class="lbl">Company / Agent</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->company_agent ?? ($reservation->company ?? '') }}</span>
                </div>
                <div class="frow">
                    <span class="lbl">Booking No.</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->booking_number }}</span>
                </div>
                <div class="frow">
                    <span class="lbl">Book By</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->book_by ?? '' }}</span>
                </div>
                <div class="frow">
                    <span class="lbl">Phone</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->phone ?? '' }}</span>
                </div>
                <div class="frow">
                    <span class="lbl">Email</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->email ?? '' }}</span>
                </div>
            </div>
            {{-- Kanan --}}
            <div class="col-right">
                <div class="frow">
                    <span class="lbl-sm">Telp</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->agent_phone ?? ($reservation->phone ?? '') }}</span>
                </div>
                <div class="frow">
                    <span class="lbl-sm">Fax</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->agent_fax ?? '' }}</span>
                </div>
                <div class="frow">
                    <span class="lbl-sm">Email</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->agent_email ?? '' }}</span>
                </div>
                <div class="frow">
                    <span class="lbl-sm">Date</span>
                    <span class="colon">:</span>
                    <span class="val">{{ now()->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <hr class="solid">

        {{-- ====== DETAIL RESERVASI ====== --}}
        <div style="margin: 3mm 0;">
            <div class="drow">
                <span class="lbl">First Name</span>
                <span class="colon">:</span>
                <span class="val">{{ $reservation->full_name }}</span>
            </div>
            <div class="drow">
                <span class="lbl">Arrival Date</span>
                <span class="colon">:</span>
                <span
                    class="val">{{ \Carbon\Carbon::parse($reservation->arrival_date)->format('d F Y') }}{{ $reservation->arrival_time ? ', ' . $reservation->arrival_time : '' }}</span>
            </div>
            <div class="drow">
                <span class="lbl">Departure Date</span>
                <span class="colon">:</span>
                <span class="val">
                    {{ \Carbon\Carbon::parse($reservation->departure_date)->format('d F Y') }}
                    @if ($reservation->status === 'checked_out' && $reservation->departure_time)
                        , Pukul {{ $reservation->departure_time }}
                    @elseif($reservation->departure_time)
                        , {{ $reservation->departure_time }}
                    @endif
                </span>
            </div>
            <div class="drow">
                <span class="lbl">Total Night</span>
                <span class="colon">:</span>
                <span
                    class="val">{{ $reservation->total_nights ?? \Carbon\Carbon::parse($reservation->arrival_date)->diffInDays($reservation->departure_date) }}</span>
            </div>
            <div class="drow">
                <span class="lbl">Room/Unit Type</span>
                <span class="colon">:</span>
                <span
                    class="val">{{ $reservation->room_type ?? '' }}{{ $reservation->room_number ? ' (No. ' . $reservation->room_number . ')' : '' }}</span>
            </div>
            <div class="drow">
                <span class="lbl">Person Pax</span>
                <span class="colon">:</span>
                <span class="val">{{ $reservation->person_pax ?? ($reservation->no_of_persons ?? '') }}</span>
            </div>
            <div class="drow">
                <span class="lbl">Room Rate Net</span>
                <span class="colon">:</span>
                <span
                    class="val">{{ $reservation->room_rate_net ? 'Rp ' . number_format($reservation->room_rate_net, 0, ',', '.') : '' }}</span>
            </div>
        </div>

        <hr class="solid">

        {{-- ====== NOTICE ====== --}}
        <div class="notice">
            Please guarantee this booking with credit card number with clear copy of the card both sides and card holder
            signature in the column provided the copy of credit card both sides should be faxed to hotel fax number.
            Please settle your outstanding to or account:
        </div>

        {{-- ====== KONDISI BERDASARKAN METODE PEMBAYARAN ====== --}}
        @if ($reservation->payment_method === 'bank_transfer')

            {{-- === BANK TRANSFER === --}}
            <div style="margin: 2mm 0 3mm;">
                <div class="pay-title">Bank Transfer</div>
                <div class="drow">
                    <span class="lbl">Mandiri Account</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->mandiri_account ?? '&nbsp;' }}</span>
                </div>
                <div class="drow">
                    <span class="lbl">Mandiri Name Account</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->mandiri_name_account ?? '&nbsp;' }}</span>
                </div>
            </div>

            <hr class="solid">

            {{-- Credit card section kosong saat bank transfer --}}
            <div style="margin: 2mm 0 3mm;">
                <div class="pay-title">Reservation guaranteed by the following credit card:</div>
                <div class="drow">
                    <span class="lbl">Card Number</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
                <div class="drow">
                    <span class="lbl">Card holder name</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
                <div class="drow">
                    <span class="lbl">Card Type</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
                <div class="drow">
                    <span class="lbl">Or by Bank Transfer to</span>
                    <span class="colon">:</span>
                    <span class="val" style="font-weight:600;">1320089175400 — a/n PPKD Jakarta Pusat</span>
                </div>
                <div class="drow">
                    <span class="lbl">Expired date/month/year</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
                <div class="drow">
                    <span class="lbl">Card holder signature</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
            </div>
        @else
            {{-- === KREDIT CARD === --}}
            <div style="margin: 2mm 0 3mm;">
                <div class="pay-title">Bank Transfer</div>
                <div class="drow">
                    <span class="lbl">Mandiri Account</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
                <div class="drow">
                    <span class="lbl">Mandiri Name Account</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
            </div>

            <hr class="solid">

            <div style="margin: 2mm 0 3mm;">
                <div class="pay-title">Reservation guaranteed by the following credit card:</div>
                <div class="drow">
                    <span class="lbl">Card Number</span>
                    <span class="colon">:</span>
                    <span class="val">
                        @if ($reservation->card_number)
                            {{ str_repeat('*', max(0, strlen($reservation->card_number) - 4)) . substr($reservation->card_number, -4) }}
                        @else
                            &nbsp;
                        @endif
                    </span>
                </div>
                <div class="drow">
                    <span class="lbl">Card holder name</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->card_holder_name ?? '&nbsp;' }}</span>
                </div>
                <div class="drow">
                    <span class="lbl">Card Type</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->card_type ?? '&nbsp;' }}</span>
                </div>
                <div class="drow">
                    <span class="lbl">Or by Bank Transfer to</span>
                    <span class="colon">:</span>
                    <span class="val" style="font-weight:600;">1320089175400 — a/n PPKD Jakarta Pusat</span>
                </div>
                <div class="drow">
                    <span class="lbl">Expired date/month/year</span>
                    <span class="colon">:</span>
                    <span class="val">{{ $reservation->card_expired ?? '&nbsp;' }}</span>
                </div>
                <div class="drow">
                    <span class="lbl">Card holder signature</span>
                    <span class="colon">:</span>
                    <span class="val">&nbsp;</span>
                </div>
            </div>

        @endif

        <hr class="solid">

        {{-- ====== CANCELLATION POLICY ====== --}}
        <div style="margin-top: 3mm;">
            <div class="cancel-title">Cancellation policy:</div>
            <ol class="cancel-list">
                <li>Please note that check in time is 02.00 pm and check out time 12.00 pm.</li>
                <li>All non guarantined reservations will automatically be released on 6 pm.</li>
                <li>The Hotel will charge 1 night for guaranteed reservations that have not been canceling before
                    the day of arrival. Please carefully note your cancellation number.</li>
            </ol>
        </div>

        {{-- ====== SIGNATURE LINE + NAMA ====== --}}
        <div style="margin-top: 14mm; display: flex; justify-content: flex-end;">
            <div style="width: 45%; text-align: center;">
                <div
                    style="border-top: 1px solid #000; padding-top: 4px; font-size: 13px; font-family: 'Times New Roman', serif;">
                    {{ $reservation->full_name }}
                </div>
            </div>
        </div>

    </div>
</body>

</html>
