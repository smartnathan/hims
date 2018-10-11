<?php

namespace App\Http\Controllers\Admin;

use App\GuestTransactionHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menu;
use App\Menuorder;
use App\Paymenttype;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        //$requestData = $request->all();
       // Menuorder::create($requestData);
        $menus = $request->menus;
        $quantity = $request->quantity;
        $x = 0;
        foreach ($menus as $menu_id) {
            $menuorder = new Menuorder;
            $menuorder->menu_id = $menu_id;
            $menuorder->user_id = $request->user_id;
            $menuorder->quantity = $quantity[$x];
            $menuorder->added_by = Auth::user()->id;
            $menuorder->save();

        //End update for previous record
        $guest_transaction = new GuestTransactionHistory;
        $guest_transaction->user_id = $request->user_id;
        $guest_transaction->type = 'food&drink';
        $guest_transaction->description = "Guest ordered for {$menuorder->menu->name}; quantity ({$menuorder->quantity})";
        $guest_transaction->price = $menuorder->menu->price * $menuorder->quantity;
        $guest_transaction->status = "debit";
        $guest_transaction->save();
        //End Guest Transction table
            $x++;
        }
        return redirect('admin/menuorders')->with('flash_message', 'Order was successfully placed!');
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
        $this->authorize('view-menuorder');
        $menuorder = Menuorder::findOrFail($id);

        return view('admin.menuorders.show', compact('menuorder'));
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
        $requestData = $request->all();
        $menuorder = Menuorder::findOrFail($id);
        $menuorder->update($requestData);

        return redirect('admin/menuorders')->with('flash_message', 'Menu order was successfully updated');
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
