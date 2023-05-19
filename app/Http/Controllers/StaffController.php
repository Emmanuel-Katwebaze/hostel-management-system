<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Staff;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        return view('pages.staff.index')->with('staff', $staff);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:staff,staff_email',
            'phone' => 'required|max:10',
            'role' => 'required:max:150',
            'salary' => 'required|numeric',
            'hiring_date' => 'required|date'
        ]);

        Staff::create([
            'staff_name' => $attributes['name'],
            'staff_email' => $attributes['email'],
            'staff_phone' => $attributes['phone'],
            'staff_role' => $attributes['role'],
            'salary' => $attributes['salary'],
            'hiring_date' => $attributes['hiring_date']
        ]);

        return redirect('staff')->with('flash_message', 'Staff Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = Staff::find($id);
        return view('pages.staff.edit')->with('staff', $staff);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = Staff::find($id);
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:staff,staff_email,' . $id,
            'phone' => 'required|max:10',
            'role' => 'required:max:150',
            'salary' => 'required|numeric',
            'hiring_date' => 'required|date'
        ]);
        //dd($attributes);
        // $staff->update($attributes);
        $staff->staff_name = $request->name;
        $staff->staff_email = $request->email;
        $staff->staff_phone = $request->phone;
        $staff->staff_role = $request->role;
        $staff->salary = $request->salary;
        $staff->hiring_date = $request->hiring_date;
        $staff->save();
        return redirect('staff')->with('flash_message', 'Staff Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Staff::destroy($id);
        return redirect('staff')->with('flash_message', 'Staff deleted!');
    }
}
