<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Row;
use App\Models\Type;
use Illuminate\Http\Request;
use function Sodium\add;

class CinemaController extends Controller
{
    public function show(Request $request)
    {
        $seats = Seat::orderBy('seat_number')->get();
        $rows = Row::all();
        $types = Type::all();
        return view("cash", compact("seats", "rows", "types"));
    }

    public function book(Request $request)
    {
        $bookedSeats = [];
        $selectedSeats = $request->input('selectedSeats');
        foreach ($selectedSeats as $seatId) {
            $cinemaSeat = Seat::find($seatId);
            $cinemaSeat->is_booked = true;
            $cinemaSeat->save();
            $bookedSeats[] = $cinemaSeat;
        }

        return response()->json(['message' => 'Места успешно забронированы', 'bookedSeats' => $bookedSeats]);
    }

    public function release(Request $request)
    {
        $releasedSeats = [];
        $selectedSeats = $request->input('selectedSeats');
        foreach ($selectedSeats as $seatId) {
            $cinemaSeat = Seat::find($seatId);
            $cinemaSeat->is_booked = false;
            $cinemaSeat->save();
            $releasedSeats[] = $cinemaSeat;
        }

        return response()->json(['message' => 'Места успешно забронированы', 'releasedSeats' => $releasedSeats]);
    }
}
