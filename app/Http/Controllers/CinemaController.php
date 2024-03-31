<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Row;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function show(Request $request)
    {
        $seats = Seat::orderBy('seat_number')->get();
        $rows = Row::all();
        return view("cash", compact("seats", "rows"));
    }

    public function book(Request $request)
    {
        $selectedSeats = $request->input('selectedSeats');

        foreach ($selectedSeats as $seatId) {
            $cinemaSeat = Seat::find($seatId);

            if ($cinemaSeat) {
                $cinemaSeat->is_booked = true;
                $cinemaSeat->save();
            }
        }

        return response()->json(['message' => 'Seats successfully booked']);
    }
}
