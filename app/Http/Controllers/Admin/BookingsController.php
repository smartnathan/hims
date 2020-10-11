<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\GuestTransactionHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menuorder;
use App\Paymenttype;
use App\Room;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view-all-booking');
        $keyword = trim($request->get('search'));
        $perPage = 25;

        if (!empty($keyword)) {
            $bookings = Booking::where('room_id', 'LIKE', "%$keyword%")
                ->orWhere('arrival_date', 'LIKE', "%$keyword%")
                ->orWhere('departure_date', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('checked_in_by', 'LIKE', "%$keyword%")
                ->orWhere('checked_out_by', 'LIKE', "%$keyword%")
                ->orWhere('paid', 'LIKE', "%$keyword%")
                ->orWhere('payment_type_id', 'LIKE', "%$keyword%")
                ->orWhere('duration', 'LIKE', "%$keyword%")
                ->orWhere('is_cancealed', 'LIKE', "%$keyword%")
                ->orWhere('date_cancealed', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $bookings = Booking::latest()->paginate($perPage);
        }

        return view('admin.bookings.index', compact('bookings'));
    }

    public function room_transfer(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            //Logics for search
        } else {
            $bookings = Booking::where('departure_date', null)->latest()->paginate($perPage);
        }


        return view('admin.bookings.room-transfer', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create-booking');
        return view('admin.bookings.create');
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
        $this->authorize('create-booking');
        $this->validate($request, [
			'room_id' => 'required',
			'arrival_date' => 'required'
		]);
        $requestData = $request->all();

        Booking::create($requestData);

        return redirect('admin/bookings')->with('flash_message', 'Booking added!');
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
        $this->authorize('view-booking');
        $booking = Booking::findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
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
        $this->authorize('update-booking');
        $booking = Booking::findOrFail($id);
        $paymenttype = Paymenttype::all();

        return view('admin.bookings.edit', compact('booking', 'paymenttype'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $idpublic function checkPrice($oldPrice, $newPrice)
    {
        if ($oldPrice < $newPrice) {
            return "debit";
        }
        elseif ($oldPrice > $newPrice) {
            return "credit";
        }
        elseif ($oldPrice == $newPrice) {
            return "match";
        }
    }
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function roomTransferUpdate(Request $request, $id)
    {

        //Room transfer logics start here
         $this->authorize('update-booking');
        if ($request->has('transfer_id') && $request->get('transfer_id') == 'trans1920') {
        $requestData = $request->all();
        $booking = Booking::findOrFail($id);
         //Find previous room and change status
        $room = Room::findOrFail($booking->room_id);
        $room['is_booked'] = 0;
        $room->save();
        //Update Guest transaction table
        //Update previous booking record
$get_previous_booking_record = GuestTransactionHistory::where('user_id', $booking->user_id)
->orderByDesc('id')->first();
$get_previous_booking_record->status = 'credit';
$get_previous_booking_record->save();
        //End update for previous record
        $room_transferred_to = Room::find($requestData['room_id']);
        $guest_transaction = new GuestTransactionHistory;
        $guest_transaction->user_id = $booking->user_id;
        $guest_transaction->type = 'room-transfer';
        $guest_transaction->room_id = $room_transferred_to->id;
        $guest_transaction->booking_id = $booking->id;
        $guest_transaction->description = "Guest was transferred to {$room_transferred_to->name} Room";
        if ($request->paid == 1) {
    $guest_transaction->price = $room_transferred_to->price * $booking->duration;
            $guest_transaction->status = "debit";
        } else {
$transfer_charges = Setting::where('name', 'ROOM_TRANSFER_CHARGES')->first()->value;
$guest_transaction->price = ($room_transferred_to->price * $booking->duration)+$transfer_charges;
         $guest_transaction->status = "debit";
        }
         $guest_transaction->save();
        //End Guest Transction table
        $roomId = $requestData['room_id'];
        $booking->room_id = $roomId;
        $new_room_price = $booking->room->price;
        $old_room_price = $requestData['old_room_price'];
        $result = abs($old_room_price - $new_room_price);
        $booking->save();

        //Update current room status
        $room = Room::findOrFail($roomId);
        $room['is_booked'] = 1;
        $room->save();

 return redirect('admin/bookings/room-transfer')->with('flash_message', 'Room transfer was successful!');

    }
}

public function update(Request $request, $id) {
    $booking = Booking::findOrFail($id);
        if ($booking->paid == 0) {
            $booking->duration = $request->input('duration');
            $booking->save();
            $guest_transaction = GuestTransactionHistory::where('booking_id', $id)->orderBy('id', 'desc')->first();
            $guest_transaction->delete();

            // Add Guest Transaction Histories
            $guest_transaction = new GuestTransactionHistory;
            $guest_transaction->user_id = $booking->user_id;
            $guest_transaction->type = 'booking';
            $guest_transaction->room_id = $booking->room_id;
            $guest_transaction->booking_id = $booking->id;
            $guest_transaction->description = "Checked into {$booking->room->name} Room for {$booking->duration} day(s)";
            $guest_transaction->price = $booking->room->price * $booking->duration;
            $guest_transaction->status = "debit";
            $guest_transaction->save();

        }
        else {
            //Changing departure state of guest first
            $booking->departure_date = Carbon::now();
            $booking->checked_out_by = Auth::id();
            $booking->save();

            //Create new instance of booking for guest
            $new_booking = Booking::create([
                'room_id' => $booking->room_id,
                'arrival_date' => $booking->arrival_date,
                'user_id' => $booking->user_id,
                'checked_in_by' => Auth::id(),
                'duration' => $request->input('duration'),
                'paid' => $request->input('paid')
            ]);
            if ($new_booking->paid == 1){
                $new_booking->paymenttype_id = $request->input('paymenttype');
                $new_booking->save();
            }

        }
    return redirect('admin/checkout')->with('flash_message', 'Room duration was successfully updated!');

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
        $this->authorize('delete-booking');
        Booking::destroy($id);

        return redirect('admin/bookings')->with('flash_message', 'Booking deleted!');
    }

    public function booking(Request $request)
    {
        $this->authorize('create-booking');
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $user = User::where('email', "$keyword")
            ->orWhere('mobile_number', "$keyword")
                ->get();
        }
        $rooms = Room::where('is_booked', 0)->get();
        $paymenttype = Paymenttype::all();
        return view('admin.bookings.book-form', compact('rooms', 'user', 'paymenttype'));
    }


    public function storebooking(Request $request)
    {
        $this->authorize('create-booking');
/* Check if a guest has booked a room before*/
$user = Booking::where('user_id', $request->user_id)
->where('departure_date', null)->first();
if (isset($user)) {
    return redirect('admin/bookroom')->with('error_message', "The guest has already been checked into {$user->room->name} room, {$user->created_at->diffForHumans()}. You can only checkout or tranfer to a different room.");
} else {
    $booking = new Booking;
        $booking['room_id'] = $request->room;
        $booking['arrival_date'] = date('Y-m-d H:i:s', time());
        $booking['user_id'] = $request->user_id;
        $booking['checked_in_by'] = Auth::user()->id;
        $booking['paid'] = $request->paid;
        if ($request->paymenttype) {
           $booking['payment_type_id'] = $request->paymenttype;
        }
        $booking['duration'] = $request->duration;
        $booking->save();
        $room = Room::findOrFail($request->room);
        $room['is_booked'] = 1;
        $room->save();

        // Add Guest Transaction Histories
        $guest_transaction = new GuestTransactionHistory;
        $guest_transaction->user_id = $request->user_id;
        $guest_transaction->type = 'booking';
        $guest_transaction->room_id = $room->id;
        $guest_transaction->booking_id = $booking->id;
        $guest_transaction->description = "Checked into {$room->name} Room for {$request->duration} day(s)";
        $guest_transaction->price = $room->price * $request->duration;
        if ($request->paid == 1) {
            $guest_transaction->status = "credit";
        } else {
             $guest_transaction->status = "debit";
        }
         $guest_transaction->save();

        if ($request->paid == 1) {
        return redirect("admin/{$request->user_id}/invoice?paid=completed")->with('booked_message', 'Room was successfully booked, print payment receipt');
        } else {
        return redirect('admin')->with('booked_message', 'Guest has been succcessfully checked into room!');
        }
}

    }

    public function invoice($id)
    {
        $this->authorize('view-booking');
        $hotel_address = Setting::where('name', 'HOTEL_ADDRESS')->first()->value;
        $total = 0;
        $user = User::find($id);
        if (request()->has('paid') && request()->get('paid') == 'completed') {
          $transactions = GuestTransactionHistory::where('user_id', $id)
        ->where('status', 'credit')
        ->whereDay('created_at', '=', date('d'))
        ->take(1)
        ->get();
          $heading = "Receipt";

        } else {
            $heading = "Invoice";
            $transactions = GuestTransactionHistory::where('booking_id', $id)
        ->where('status', 'debit')->get();
        }

            return view('admin.bookings.invoice', compact('transactions', 'total', 'user', 'heading', 'hotel_address'));
    }

    public function checkoutCreate(Request $request)
    {
        $this->authorize('create-booking');
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            // $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
            // ->where('departure_date', NULL)
            // ->where('firstname', 'LIKE', "%$keyword%")
            // ->orWhere('surname', 'LIKE', "%$keyword%")
            // ->get();

            // $bookings =
            // ->join('users', 'users.id', '=', 'bookings.user_id')
            // ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            // ->join('guest_transaction_histories', 'guest_transaction_histories.user_id', '=', 'users.id')
            // ->where('firstname', 'LIKE', "%$keyword%")
            // ->where('departure_date', null)
            // ->orWhere('surname', 'LIKE', "%$keyword%")
            // ->limit(1)
            // ->get();

            $bookings = Booking::with(['user.transactionHistories', 'room'])
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->join('guest_transaction_histories', 'guest_transaction_histories.user_id', '=', 'users.id')
            ->where('firstname', 'LIKE', "%$keyword%")
             ->where('departure_date', null)
             ->orWhere('surname', 'LIKE', "%$keyword%")
             ->orderBy('bookings.id', 'asc')
             ->limit(1)
             ->get();

        } else {
            $bookings = Booking::where('departure_date', null)->latest()->paginate($perPage);
        }
        return view('admin.bookings.checkout', compact('bookings'));
    }

    public function checkout($id)
    {
        $this->authorize('create-booking');
        $booking = Booking::where('user_id', $id)
        ->where('departure_date', NULL)->latest()->first();
        $room_id = $booking['room_id'];
        $room = Room::findOrFail($room_id);
        $room['is_booked'] = 0;
        $room->save();
        $booking['departure_date'] = date('Y-m-d H:i:s', time());
        $booking['checked_out_by'] = Auth::user()->id;
        $booking->save();
return redirect('admin/checkout');
//->with('flash_message', 'Guest has been successfully checked out');
    }

    public function updateInvoice($id){
        $this->authorize('update-userorder');
        Menuorder::where('booking_id', $id)
            ->update(['paid' => 1]);
        Booking::where('id', $id)
            ->update(['paid' => 1]);
        GuestTransactionHistory::where('booking_id', $id)
            ->update(['status' => 'credit']);
        return redirect('admin/checkout');
    }

    public function receipt($id) {
        $total = 0;
        $hotel_address = Setting::where('name', 'HOTEL_ADDRESS')->first()->value;

        $transactions = GuestTransactionHistory::where('booking_id', $id)
            ->where('status', 'credit')->get();
        return view('admin.bookings.receipt', compact('transactions', 'total', 'hotel_address'));
    }


}
