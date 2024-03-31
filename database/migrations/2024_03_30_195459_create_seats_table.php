<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rows', function (Blueprint $table) {
            $table->id();
            $table->integer('row_number');
            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('row_id');
            $table->integer('seat_number');
            $table->boolean('is_booked')->default(false);
            $table->timestamps();

            // Добавляем внешний ключ
            $table->foreign('row_id')->references('id')->on('rows');

            // Если вам нужен еще и уникальный индекс для номера ряда и места
            $table->unique(['row_id', 'seat_number'], 'unique_row_seat');
        });

        Artisan::call('db:seed', ['--class' => 'CinemaSeeder']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_seats');
        Schema::dropIfExists('rows');
    }
};
