<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\GuestTransactionHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menu;
use App\Menuorder;
use App\Paymenttype;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Setting;

class MenuordersController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Menuorder::class);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $this->authorize('view-all-menuorder', Menuorder::class);
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $menuorders = Menuorder::where('menu_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('paid', 'LIKE', "%$keyword%")
                ->orWhere('payment_type_id', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $menuorders = Menuorder::latest()->paginate($perPage);
        }

        return view('admin.menuorders.index', compact('menuorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create-menuorder');
        $guests = Role::where('name', 'guest')->get();
        $menus = Menu::select('id', 'name', 'price')->get();
        //$paymenttype = Paymenttype::all();
        return view('admin.menuorders.create', compact('menus', 'guests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create-menuorder');
        //Check if the user is currently checked into the hotel
        $verify_user = Booking::where('user_id', $request->user_id)
        ->where('departure_date', NULL)->first();
        if (! $verify_user) {
            return redirect('admin/menuorders/create')->with('error_message', "Sorry! This Guest has been not been checked into any room in the hotel");
        } else {

        //$requestData = $request->all();
       // Menuorder::create($requestData);
        $menus = $request->menus;
        $quantity = $request->quantity;
        $x = 0;
        foreach ($menus as $menu_id) {
            $menuorder = new Menuorder;
            $menuorder->menu_id = $menu_id;
            $menuorder->booking_id = $verify_user->id;
            $menuorder->user_id = $request->user_id;
            $menuorder->quantity = $quantity[$x];
            $menuorder->added_by = Auth::user()->id;
            $menuorder->room_id = $verify_user->room_id;
            $menuorder->save();

        //End update for previous record
        $guest_transaction = new GuestTransactionHistory;
        $guest_transaction->user_id = $request->user_id;
        $guest_transaction->type = 'food&drink';
        $guest_transaction->room_id = $verify_user->room_id;
        $guest_transaction->description = "Guest ordered for {$menuorder->menu->name}; quantity ({$menuorder->quantity})";
        $guest_transaction->price = $menuorder->menu->price * $menuorder->quantity;
        $guest_transaction->status = "debit";
        $guest_transaction->save();
        //End Guest Transction table
            $x++;
        }
        return redirect('admin/menuorders')->with('flash_message', 'Order was successfully placed!');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $total = 0;
        $hotel_address = Setting::where('name', 'HOTEL_ADDRESS')->first()->value;

        $this->authorize('view-menuorder');
        //$menuorder = Menuorder::findOrFail($id);
        $booking = Booking::where('user_id', $id)
        ->where('departure_date', null)->first();
        //dd($booking);

        if (request()->has('print') && decrypt(request()->get('print')) == $id) {
            $transactions = Menuorder::where('user_id', $id)
            ->where('room_id', $booking->room_id)
            ->orderByDesc('id')->where('paid', 0)->get();
        }
            $menuorder = Menuorder::where('user_id', $id)
            ->where('room_id', $booking->room_id)
            ->orderByDesc('id')->get();
        
        return view('admin.menuorders.show', compact('hotel_address', 'menuorder', 'transactions', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('update-menuorder');
        $menuorder = Menuorder::findOrFail($id);
        $menus = Menu::select('id', 'name', 'price')->get();
        $guests = Role::where('name', 'guest')->get();
        return view('admin.menuorders.edit', compact('menus','menuorder', 'guests'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update-menuorder');
        $menuitems = $request->menuitems;
        foreach ($menuitems as $item) {
        $menuorder = Menuorder::findOrFail($item);
        $menuorder->update(['status' => 1]);
        }

        if ($request->has('itempaid')) {
            $guest_transaction = GuestTransactionHistory::where('user_id', $id)
            ->where('type', 'food&drink')
            ->update(['status'=> 'credit']);

            foreach ($menuitems as $item) {
        $menuorder = Menuorder::findOrFail($item);
        $menuorder->update(['paid' => 1]);
        }
        }

        return redirect('admin/menuorders/'. $id)->with('flash_message', 'Food And drink order was successfully updated!');
    }

    public function updateUserOrder($id)
    {
        $this->authorize('update-userorder');
        Menuorder::where('user_id', $id)
        ->update(['paid' => 1]);
        GuestTransactionHistory::where('user_id', $id)
        ->update(['status' => 'credit']);
        return redirect('admin/checkout');
        //->with('flash_message', 'Payment was completed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->authorize('delete-menuorder');
        Menuorder::destroy($id);

        return redirect('admin/menuorders')->with('flash_message', 'Menuorder deleted!');
    }
}
