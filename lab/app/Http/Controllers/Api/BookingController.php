<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    // store booking
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required_if:type,home',
            'branche_id' => 'required',
            'test_id' => 'required',
            'culture_id' => 'required',
            'package_id' => 'required',
            'type' => 'required',
        ]);

        $booking = new Booking();
        $booking->patient_id = auth()->user()->id;
        $booking->address = $request->address;
        $booking->branche_id = $request->branche_id;
        $booking->test_id = $request->test_id;
        $booking->culture_id = $request->culture_id;
        $booking->package_id = $request->package_id;
        $booking->type = $request->type;

        $booking->save();

        $data = [
            'address' => $booking->address,
            'branche' => $booking->branche->name,
            'test' => $booking->test->name,
            'culture' => $booking->culture->name,
            'package' => $booking->package->name,
            'type' => $booking->type,
        ];

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $data,
        ], 201);
    }

    // index
    public function index()
    {
        $bookings = Booking::where('patient_id', auth()->user()->id)->get();
        $data = [];
        foreach ($bookings as $booking) {
            $data[] = [
                'address' => $booking->address,
                'branche' => $booking->branche->name,
                'test' => $booking->test->name,
                'culture' => $booking->culture->name,
                'package' => $booking->package->name,
            ];
        }

        return response()->json([
            'message' => 'Bookings retrieved successfully',
            'bookings' => $data,
        ], 200);
    }
}
