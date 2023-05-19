<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\GuestBooking;
use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guestBookings = GuestBooking::all();
        return view('pages.guest-booking.index')->with('guestBookings', $guestBookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $category, string $id)
    {
        $hostelRoom = HostelRoom::find($id);


        return view('pages.guest-booking.create', compact('hostelRoom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bedSpace = intval($request->bed_space);

        $attributes = request()->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255|exists:users,email',
            'phone_number' => 'required|max:255|',
            'bed_space' => 'required|numeric|',
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
            'user_id' => $user->id,
            'hostel_room_id' => $hostelRoom->id
        ]);

        $hostelRoom->bed_space = $hostelRoom->hostelRoomType->room_capacity - $bedSpace;
        if ($hostelRoom->bed_space == 0) {
            $hostelRoom->status = 'Unavailable';
        }
        $hostelRoom->save();

        return redirect('guest-booking')->with('flash_message', 'Guest Booking Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = GuestBooking::find($id);
        return view('pages.guest-booking.show')->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rooms = HostelRoom::where('status', 'Available')
            ->get();

        $booking = GuestBooking::find($id);

        return view('pages.guest-booking.edit', compact('rooms', 'booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = GuestBooking::find($id);
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


        $booking->first_name = $attributes['first_name'];
        $booking->last_name = $attributes['last_name'];
        $booking->email = $attributes['email'];
        $booking->bed_space = $bedSpace;
        $booking->phone_number = $attributes['phone_number'];
        $booking->check_in_date = $attributes['check_in_date'];
        $booking->check_out_date = $attributes['check_out_date'];
        $booking->amount_paid = $attributes['amount_paid'];
        $booking->balance = $attributes['balance'];
        $booking->user_id = $user->id;
        $booking->hostel_room_id = $hostelRoom->id;
        $booking->save();

        $hostelRoom->bed_space = $hostelRoom->hostelRoomType->room_capacity - $bedSpace;
        if ($hostelRoom->bed_space == 0) {
            $hostelRoom->status = 'Unavailable';
        } else {
            $hostelRoom->status = 'Available';
        }
        $hostelRoom->save();

        return redirect('guest-booking')->with('flash_message', 'Guest Booking Updated!');
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

        return redirect('guest-booking')->with('flash_message', 'Guest Booking deleted!');
    }

    public function select_category()
    {

        $hostelRoomTypes = HostelRoomType::all();
        return view('pages.guest-booking.select-category')->with('hostelRoomTypes', $hostelRoomTypes);
    }

    public function select_room(string $category)
    {
        // Retrieve the hostel room type ID
        $hostelRoomType = DB::table('hostel_room_types')
            ->where('room_type', $category)
            ->select('*')
            ->first();

        // Retrieve the available hostel rooms
        $hostelRooms = DB::table('hostel_rooms')
            ->where('hostel_room_type_id', $hostelRoomType->id)
            ->where('status', 'Available')
            ->get();

        return view('pages.guest-booking.select-room', compact('hostelRoomType', 'hostelRooms'));
    }
}
