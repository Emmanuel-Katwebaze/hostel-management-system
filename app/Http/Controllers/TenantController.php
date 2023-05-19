<?php

namespace App\Http\Controllers;

use App\Models\tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenant = tenant::all();
        return view('pages.tenants.index')->with('tenant', $tenant);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:tenant,email',
            'phone' => 'required|max:255',
            'gender' => 'required:max:150'
        ]);

        tenant::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
            'gender' => $attributes['gender']
        ]);

        return redirect('tenant')->with('flash_message', 'Tenant Added!');
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
        $tenant = tenant::find($id);
        return view('pages.tenants.edit')->with('tenant', $tenant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tenant = tenant::find($id);
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:tenant,email,' . $id,
            'phone' => 'required|max:255',
            'gender' => 'required:max:150'
        ]);
        //dd($attributes);
        // $tenant->update($attributes);
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->gender = $request->gender;
        $tenant->save();
        return redirect('tenant')->with('flash_message', 'Tenant Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        tenant::destroy($id);
        return redirect('tenant')->with('flash_message', 'Tenant deleted!');
    }
}
