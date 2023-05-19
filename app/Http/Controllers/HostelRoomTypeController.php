<?php

namespace App\Http\Controllers;

use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostelRoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostelRoomTypes = HostelRoomType::all();
        return view('pages.categories.index')->with('hostelRoomTypes', $hostelRoomTypes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostelRoomTypes = HostelRoomType::all();
        return view('pages.categories.create')->with('hostelRoomType', $hostelRoomTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'category' => 'required|max:255|unique:hostel_room_types,room_type',
            'price' => 'required|numeric|',
            'capacity' => 'required|numeric|',
            'description' => 'required|max:255',
            'photo' => 'required|image',
        ]);

        $fileName = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $attributes['photo'] = '/storage/' . $path;

        HostelRoomType::create([
            'room_type' => $attributes['category'],
            'room_price' => $attributes['price'],
            'room_capacity' => $attributes['capacity'],
            'room_description' => $attributes['description'],
            'room_type_photo' => $attributes['photo'],
        ]);

        return redirect('categories')->with('flash_message', 'Hostel Room Category Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hostelRoomType = HostelRoomType::find($id);

        //Query database to find the id of the new room type
        $hostelRooms = DB::table('hostel_rooms')
            ->where('hostel_room_type_id', $hostelRoomType->id)
            ->get();

        // dd($hostelRooms);
        return view('pages.categories.show', compact('hostelRoomType', 'hostelRooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hostelRoomType = HostelRoomType::find($id);
        return view('pages.categories.edit')->with('hostelRoomType', $hostelRoomType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hostelRoomType = HostelRoomType::find($id);
        $attributes = request()->validate([
            'category' => 'required|max:255|unique:hostel_room_types,room_type,' . $id,
            'price' => 'required|numeric|',
            'capacity' => 'required|numeric|',
            'description' => 'required|max:255',
            'photo' => 'sometimes|image',
        ], [
            'photo.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)',
        ]);

        if (!isset($attributes['photo'])) {
            // If the "photo" field is not set, use the existing photo from the database
            $attributes['photo'] = $hostelRoomType->room_type_photo;
        } else {
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $attributes['photo'] = '/storage/' . $path;
        }
        $hostelRoomType->room_type = $attributes['category'];
        $hostelRoomType->room_price = $attributes['price'];
        $hostelRoomType->room_capacity = $attributes['capacity'];
        $hostelRoomType->room_description = $attributes['description'];
        $hostelRoomType->room_type_photo = $attributes['photo'];
        $hostelRoomType->save();

        return redirect('categories')->with('flash_message', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $hostelRoomType = HostelRoomType::find($id);

        $unassignedRoomType = HostelRoomType::where('room_type', 'Unassigned')->first();
        if ($unassignedRoomType) {
            DB::table('hostel_rooms')
                ->where('hostel_room_type_id', $hostelRoomType->id)
                ->update([
                    'hostel_room_type_id' => $unassignedRoomType->id,
                    'status' => 'Unavailable'
                ]);
        }

        HostelRoomType::destroy($id);
        return redirect('categories')->with('flash_message', 'Category deleted!');
    }

    public function category_create(string $id)
    {
        $hostelRoomType = HostelRoomType::find($id);
        $hostelRoomTypes = HostelRoomType::all();

        return view('pages.hostel-rooms.create', compact('hostelRoomType', 'hostelRoomTypes'));
    }

    public function category_store(Request $request)
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
            ->select('id')
            ->first();

        HostelRoom::create([
            'room_number' => $attributes['room_number'],
            'floor_level' => $attributes['floor_level'],
            'bed_space' => $roomType->room_capacity,
            'status' => $attributes['status'],
            'hostel_room_type_id' => $roomType->id
        ]);


        return redirect("categories/$roomType->id/")->with('flash_message', 'Hostel Room Added!');
    }
}
