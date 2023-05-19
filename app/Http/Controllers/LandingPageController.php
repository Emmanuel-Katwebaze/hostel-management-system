<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $categories = HostelRoomType::all();
        $facilities = Facility::all();
        $rooms = HostelRoom::where('status', 'Available')
            ->get();

        return view('landingPage', compact('categories', 'facilities', 'rooms'));
    }
}
