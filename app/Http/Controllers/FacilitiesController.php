<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilitiesController extends Controller
{

    public function index()
    {

        // $facilities = Facility::orderBy('created_at', 'desc')->paginate(4);
        // return view('pages.facilities.index')->with('facilities', $facilities);

        $facilities = Facility::all();
        return view('pages.facilities.index')->with('facilities', $facilities);
    }

    public function create()
    {

        return view('pages.facilities.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'facility_name' => 'required|max:255',
            'facility_description' => 'required',
            'availability' => 'required|max:255',
            'photo' => 'required|image',
        ], [
            'photo.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)',
        ]);

        $fileName = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $attributes['photo'] = '/storage/' . $path;

        // Create the Facility
        $facility = new Facility;
        $facility->Facility_Name = $request->input('facility_name');
        $facility->Description = $request->input('facility_description');
        $facility->Availability = $request->input('availability');
        $facility->facility_photo = $attributes['photo'];
        $facility->save();

        return redirect('facilities')->with('flash_message', 'New Facility was Added!');
    }
    public function show(string $id)
    {
        $facility = Facility::find($id);
        return view('pages.facilities.show')->with('facility', $facility);
    }


    public function edit(string $id)
    {
        $facility = Facility::find($id);
        return view('pages.facilities.edit')->with('facility', $facility);
    }


    public function update(Request $request, string $id)
    {
        $facility = Facility::find($id);
        $attributes = request()->validate([
            'facility_name' => 'required|max:255|unique:hostel_room_types,room_type,' . $id,
            'facility_description' => 'required',
            'availability' => 'required|max:255',
            'photo' => 'sometimes|image',
        ], [
            'photo.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)',
        ]);

        if (!isset($attributes['photo'])) {
            // If the "photo" field is not set, use the existing photo from the database
            $attributes['photo'] = $facility->facility_photo;
        } else {
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $attributes['photo'] = '/storage/' . $path;
        }

        $facility->Facility_Name = $attributes['facility_name'];
        $facility->Description = $attributes['facility_description'];
        $facility->Availability = $attributes['availability'];
        $facility->facility_photo = $attributes['photo'];
        $facility->save();

        return redirect('facilities')->with('flash_message', 'Facility Updated');
    }


    public function destroy(string $id)
    {
        Facility::destroy($id);
        return redirect('facilities')->with('flash_message', 'Facility deleted!');
    }
}
