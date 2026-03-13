<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();

            // Room Info
            $table->string('room_number')->nullable();
            $table->string('room_type')->nullable();
            $table->integer('no_of_persons')->nullable();
            $table->integer('no_of_rooms')->default(1);
            $table->string('receptionist')->nullable();

            // Guest Info
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('profession')->nullable();
            $table->string('company')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('member_no')->nullable();

            // Booking Info
            $table->string('company_agent')->nullable();
            $table->string('book_by')->nullable();
            $table->string('agent_phone')->nullable();
            $table->string('agent_fax')->nullable();
            $table->string('agent_email')->nullable();

            // Stay Info
            $table->dateTime('arrival_date');
            $table->time('arrival_time')->nullable();
            $table->dateTime('departure_date');
            $table->integer('total_nights')->nullable();
            $table->integer('person_pax')->nullable();
            $table->decimal('room_rate_net', 12, 2)->nullable();
            $table->string('room_unit_type')->nullable();

            // Payment
            $table->enum('payment_method', ['credit_card', 'bank_transfer'])->default('bank_transfer');
            $table->string('card_number')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_expired')->nullable();
            $table->string('mandiri_account')->nullable();
            $table->string('mandiri_name_account')->nullable();

            // Safety Deposit Box
            $table->string('safety_deposit_box_no')->nullable();
            $table->string('issued_by')->nullable();
            $table->date('issued_date')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
