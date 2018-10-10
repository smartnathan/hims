<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Menuorder;
use App\Room;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $bookings_today = Booking::whereDay('created_at', '=', date('d'))->get();
        $rooms = Room::where('is_booked', 0)->get();
        $menuorders = Menuorder::whereDay('created_at', '=', date('d'))->get();
        $bookings = Booking::latest()->paginate(5);
        return view('admin.dashboard', compact('bookings', 'bookings_today', 'menuorders', 'rooms'));
    }
}
