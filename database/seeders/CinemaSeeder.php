<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Row;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = 10; // Количество рядов
        $seatsPerRow = 15; // Количество мест в каждом ряду

        for ($row = 1; $row <= $rows; $row++) {
            // Создаем ряд
            $rowModel = Row::create([
                'row_number' => $row
            ]);

            // Создаем места для каждого ряда
            for ($seat = 1; $seat <= $seatsPerRow; $seat++) {
                Seat::create([
                    'row_id' => $rowModel->id,
                    'seat_number' => $seat,
                    'is_booked' => false
                ]);
            }
        }
    }
}
