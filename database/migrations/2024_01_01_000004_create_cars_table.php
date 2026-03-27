<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plate');
            $table->string('model')->nullable();
            $table->timestamps();
        });

        Schema::create('car_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('car');
            $table->date('date');
            $table->string('hour');
            $table->string('destination');
            $table->string('reason')->nullable();
            $table->enum('status', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_reservations');
        Schema::dropIfExists('company_cars');
    }
};
