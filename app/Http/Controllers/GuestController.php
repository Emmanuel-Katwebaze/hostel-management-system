<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Facility;
use App\Models\GuestBooking;
use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = HostelRoomType::all();
        $facilities = Facility::all();
        $rooms = HostelRoom::where('status', 'Available')
            ->get();

        return view('landingPage', compact('categories', 'facilities', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $hostelRoom = HostelRoom::find($id);
        $facilities = Facility::all();

        return view('guest.createBooking', compact('hostelRoom', 'facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guest = request()->user();
        $bedSpace = intval($request->bed_space);


        $attributes = request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255|exists:users,email',
            'phone_number' => 'required|max:255|',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->select('id')
            ->first();

        $hostelRoom = HostelRoom::where('room_number', $request->room_number)
            ->first();

        GuestBooking::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'bed_space' => $bedSpace,
            'phone_number' => $attributes['phone_number'],
            'check_in_date' => $attributes['check_in_date'],
            'check_out_date' => $attributes['check_out_date'],
            'amount_paid' => $attributes['amount_paid'],
            'balance' => $attributes['balance'],
            'user_id' => $guest->id,
            'hostel_room_id' => $hostelRoom->id
        ]);

        // update the availability of the bed to "occupied"
        $hostelRoom->bed_space = $hostelRoom->bed_space - $bedSpace;
        if ($hostelRoom->bed_space == 0) {
            $hostelRoom->status = 'Unavailable';
        }
        $hostelRoom->save();

        return redirect('guest')->with('flash_message', 'Thank you for Booking!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = GuestBooking::find($id);
        $facilities = Facility::all();

        return view('guest.showBooking', compact('booking', 'facilities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getBookings()
    {
        $user = request()->user();
        $facilities = Facility::all();

        $bookings = GuestBooking::where('user_id', $user->id)
            ->get();

        return view('guest.getBookings', compact('bookings', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest_booking = GuestBooking::find($id);
        $hostelRoom = HostelRoom::where('room_number', $guest_booking->hostelRoom->room_number)
            ->first();
        $hostelRoom->bed_space = intval($hostelRoom->bed_space) + intval($guest_booking->bed_space);
        $hostelRoom->status = 'Available';
        $hostelRoom->save();

        GuestBooking::destroy($id);

        return redirect('guest/bookings')->with('flash_message', 'Booking canceled!');
    }
}
