<?php

namespace App\Http\Controllers;

use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostelRooms = HostelRoom::all();
        return view('pages.hostel-rooms.index')->with('hostelRooms', $hostelRooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostelRoomType = null;
        $hostelRoomTypes = HostelRoomType::all();

        return view('pages.hostel-rooms.create', compact('hostelRoomType', 'hostelRoomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'room_number' => 'required|max:4|regex:/^[A-Z][0-9]{0,3}$/|unique:hostel_rooms,room_number',
            'floor_level' => 'required|max:255',
            'room_type' => 'required|max:255',
            'status' => 'required|max:255',
        ]);



        //Query database to find the id of the room type
        $roomType = DB::table('hostel_room_types')
            ->where('room_type', '=', "$request->room_type")
            ->select('*')
            ->first();

        HostelRoom::create([
            'room_number' => $attributes['room_number'],
            'floor_level' => $attributes['floor_level'],
            'bed_space' => $roomType->room_capacity,
            'status' => $attributes['status'],
            'hostel_room_type_id' => $roomType->id
        ]);


        return redirect('categories/' . $roomType->id)->with('flash_message', 'Hostel Room Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hostelRoom = HostelRoom::find($id);
        return view('pages.hostel-rooms.show')->with('hostelRoom', $hostelRoom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hostelRoom = HostelRoom::find($id);
        $hostelRoomTypes = HostelRoomType::all();

        return view('pages.hostel-rooms.edit', compact('hostelRoom', 'hostelRoomTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hostelRoom = HostelRoom::find($id);
        $attributes = request()->validate([
            'room_number' => 'required|max:4|regex:/^[A-Z][0-9]{0,3}$/|unique:hostel_rooms,room_number,' . $id,
            'floor_level' => 'required|max:255',
            'room_type' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        //Query database to find the id of the new room type
        $newRoomType = DB::table('hostel_room_types')
            ->where('room_type', '=', "$request->room_type")
            ->select('*')
            ->first();

        $hostelRoom->room_number = $request->room_number;
        $hostelRoom->floor_level = $request->floor_level;
        $hostelRoom->bed_space = $newRoomType->room_capacity;
        $hostelRoom->status = $request->status;
        $hostelRoom->hostel_room_type_id = $newRoomType->id;
        $hostelRoom->save();

        return redirect('hostel-rooms')->with('flash_message', 'Hostel Room Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HostelRoom::destroy($id);
        return redirect('hostel-rooms')->with('flash_message', 'Hostel Room deleted!');
    }
}
