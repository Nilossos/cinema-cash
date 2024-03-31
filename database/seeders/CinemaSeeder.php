<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Row;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = 10;
        $seatsPerRow = 15;
        $type = Type::create([
            'title' => "Classic"
        ]);
        for ($row = 1; $row <= $rows; $row++) {
            $rowModel = Row::create([
                'row_number' => $row
            ]);

            for ($seat = 1; $seat <= $seatsPerRow; $seat++) {
                Seat::create([
                    'row_id' => $rowModel->id,
                    'type_id' => $type->id,
                    'seat_number' => $seat,
                ]);
            }
        }
        $type = Type::create([
            'title' => "Relax"
        ]);
        for ($row = $rows+1; $row <= $rows+3; $row++) {
            $rowModel = Row::create([
                'row_number' => $row
            ]);

            for ($seat = 1; $seat <= $seatsPerRow; $seat++) {
                Seat::create([
                    'row_id' => $rowModel->id,
                    'type_id' => $type->id,
                    'seat_number' => $seat,
                ]);
            }
        }
    }
}
