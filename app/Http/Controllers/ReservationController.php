<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->paginate(15);
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'nullable|string|max:255',
            'room_number'     => 'nullable|string|max:50',
            'room_type'       => 'nullable|string|max:100',
            'no_of_persons'   => 'nullable|integer|min:1',
            'no_of_rooms'     => 'nullable|integer|min:1',
            'receptionist'    => 'nullable|string|max:255',
            'profession'      => 'nullable|string|max:255',
            'company'         => 'nullable|string|max:255',
            'nationality'     => 'nullable|string|max:100',
            'passport_no'     => 'nullable|string|max:100',
            'birth_date'      => 'nullable|date',
            'address'         => 'nullable|string',
            'phone'           => 'nullable|string|max:30',
            'mobile_phone'    => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'member_no'       => 'nullable|string|max:100',
            'arrival_date'    => 'required|date',
            'arrival_time'    => 'nullable|string',
            'departure_date'  => 'required|date|after:arrival_date',
            'person_pax'      => 'nullable|integer|min:1',
            'room_rate_net'   => 'nullable|numeric|min:0',
            'room_unit_type'  => 'nullable|string|max:100',
            'payment_method'  => 'nullable|in:credit_card,bank_transfer',
            'card_number'          => 'nullable|string|max:50',
            'card_holder_name'     => 'nullable|string|max:255',
            'card_type'            => 'nullable|string|max:50',
            'card_expired'         => 'nullable|string|max:20',
            'mandiri_account'      => 'nullable|string|max:100',
            'mandiri_name_account' => 'nullable|string|max:255',

            'company_agent'   => 'nullable|string|max:255',
            'book_by'         => 'nullable|string|max:255',
            'agent_phone'     => 'nullable|string|max:30',
            'agent_fax'       => 'nullable|string|max:30',
            'agent_email'     => 'nullable|email|max:255',
            'safety_deposit_box_no' => 'nullable|string|max:100',
            'issued_by'       => 'nullable|string|max:255',
            'issued_date'     => 'nullable|date',
            'notes'           => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil disimpan dengan nomor booking: ' . $reservation->booking_number);
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'arrival_date'   => 'required|date',
            'departure_date' => 'required|date|after:arrival_date',
        ]);

        $reservation->update($request->all());
        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
        ]);

        $oldStatus = $reservation->status;
        $reservation->update(['status' => $request->status]);

        $labels = [
            'pending'     => 'Pending',
            'confirmed'   => 'Confirmed',
            'checked_in'  => 'Check-In',
            'checked_out' => 'Check-Out',
            'cancelled'   => 'Dibatalkan',
        ];

        return redirect()->back()
            ->with('success', "Status reservasi {$reservation->booking_number} berhasil diubah dari {$labels[$oldStatus]} → {$labels[$request->status]}");
    }

    public function print(Reservation $reservation)
    {
        return view('print.reservation', compact('reservation'));
    }

    public function printRegistration(Reservation $reservation)
    {
        return view('print.registration', compact('reservation'));
    }
}