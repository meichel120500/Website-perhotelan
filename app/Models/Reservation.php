<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number', 'room_number', 'room_type', 'no_of_persons', 'no_of_rooms',
        'receptionist', 'first_name', 'last_name', 'profession', 'company',
        'nationality', 'passport_no', 'birth_date', 'address', 'phone',
        'mobile_phone', 'email', 'member_no', 'company_agent', 'book_by',
        'agent_phone', 'agent_fax', 'agent_email', 'arrival_date', 'arrival_time',
        'departure_date', 'total_nights', 'person_pax', 'room_rate_net',
        'room_unit_type', 'payment_method', 'card_number', 'card_holder_name',
        'card_type', 'card_expired', 'mandiri_account', 'mandiri_name_account',
        'safety_deposit_box_no', 'issued_by', 'issued_date', 'status', 'notes',
    ];

    protected $casts = [
        'arrival_date' => 'datetime',
        'departure_date' => 'datetime',
        'birth_date' => 'date',
        'issued_date' => 'date',
        'room_rate_net' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($reservation) {
            $reservation->booking_number = 'PPKD-' . strtoupper(uniqid());
            if ($reservation->arrival_date && $reservation->departure_date) {
                $reservation->total_nights = \Carbon\Carbon::parse($reservation->arrival_date)
                    ->diffInDays(\Carbon\Carbon::parse($reservation->departure_date));
            }
        });
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
