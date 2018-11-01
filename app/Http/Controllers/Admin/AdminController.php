<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\GuestTransactionHistory;
use App\Http\Controllers\Controller;
use App\Menu;
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
        $keyword = request()->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $food_drinks = Menu::where('name', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
           $food_drinks = Menu::paginate($perPage);
        }

        $bookings_today = Booking::whereDay('created_at', '=', date('d'))->get();
        $income_today = GuestTransactionHistory::whereDay('created_at', '=', date('d'))->get();
        $total_income = 0;
        foreach ($income_today as $income) {
            $total_income += $income->price;
        }
        $rooms = Room::where('is_booked', 0)->get();
        $menuorders = Menuorder::whereDay('created_at', '=', date('d'))->get();
        $bookings = Booking::latest()->paginate(5);
        return view('admin.dashboard', compact('food_drinks','bookings', 'bookings_today', 'menuorders', 'rooms', 'total_income'));
    }
}
