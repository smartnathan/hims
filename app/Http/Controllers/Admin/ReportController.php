<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\GuestTransactionHistory;
use App\Menuorder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function roomsBooking (Request $request){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $total = 0;
        $query = $request->get('search');
        if (!empty($query)){
            if ($query == 'today'){
                $date = Carbon::today();
               $reports = Booking::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
               return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'yesterday'){
                $date = Carbon::yesterday();
                $reports = Booking::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::today())->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'thisweek'){
                $date = Carbon::now()->startOfWeek();
                $reports = Booking::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastweek'){
                $date = Carbon::now()->subWeek()->startOfWeek();
                $reports = Booking::where('created_at', '>=', $date)
                ->where('created_at', '<=', Carbon::now()->startOfWeek())->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'thismonth'){
                $date = Carbon::now()->startOfMonth();
                $reports = Booking::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastmonth'){
                $date = Carbon::now()->startOfMonth()->subMonth();
                $reports = Booking::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfMonth())->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'thisyear'){
                $date = Carbon::now()->startOfYear();
                $reports = Booking::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastyear'){
                $date = Carbon::now()->startOfYear()->subYear();
                $reports = Booking::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfYear())->orderBy('id', 'desc')->get();
                return view('admin.reports.room-report', compact('reports', 'total'));
            }
        }
        else {
            $reports = Booking::orderBy('id', 'desc')->paginate(30);
            return view('admin.reports.room-report', compact('reports', 'total'));
        }
    }


    public function foodAndDrinksOrder(Request $request){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $total = 0;
        $query = $request->get('search');
        if (!empty($query)){
            if ($query == 'today'){
                $date = Carbon::today();
                $reports = Menuorder::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'yesterday'){
                $date = Carbon::yesterday();
                $reports = Menuorder::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::today())->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'thisweek'){
                $date = Carbon::now()->startOfWeek();
                $reports = Menuorder::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastweek'){
                $date = Carbon::now()->subWeek()->startOfWeek();
                $reports = Menuorder::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfWeek())->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'thismonth'){
                $date = Carbon::now()->startOfMonth();
                $reports = Menuorder::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastmonth'){
                $date = Carbon::now()->startOfMonth()->subMonth();
                $reports = Menuorder::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfMonth())->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'thisyear'){
                $date = Carbon::now()->startOfYear();
                $reports = Menuorder::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastyear'){
                $date = Carbon::now()->startOfYear()->subYear();
                $reports = Menuorder::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfYear())->orderBy('id', 'desc')->get();
                return view('admin.reports.food-drink-report', compact('reports', 'total'));
            }
        }
        else {
            $reports = Menuorder::orderBy('id', 'desc')->paginate(30);
            return view('admin.reports.food-drink-report', compact('reports', 'total'));
        }
    }

    public function generalReport(Request $request){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $total = 0;
        $query = $request->get('search');
        if (!empty($query)){
            if ($query == 'today'){
                $date = Carbon::today();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'yesterday'){
                $date = Carbon::yesterday();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::today())->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'thisweek'){
                $date = Carbon::now()->startOfWeek();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastweek'){
                $date = Carbon::now()->subWeek()->startOfWeek();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfWeek())->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'thismonth'){
                $date = Carbon::now()->startOfMonth();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastmonth'){
                $date = Carbon::now()->startOfMonth()->subMonth();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfMonth())->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'thisyear'){
                $date = Carbon::now()->startOfYear();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
            elseif ($query == 'lastyear'){
                $date = Carbon::now()->startOfYear()->subYear();
                $reports = GuestTransactionHistory::where('created_at', '>=', $date)
                    ->where('created_at', '<=', Carbon::now()->startOfYear())->orderBy('id', 'desc')->get();
                return view('admin.reports.general-report', compact('reports', 'total'));
            }
        }
        else {
            $reports = GuestTransactionHistory::orderBy('id', 'desc')->paginate(30);
            return view('admin.reports.general-report', compact('reports', 'total'));
        }
    }
}
