<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemStock;
use Illuminate\Http\Request;

class ItemStocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $itemstocks = ItemStock::where('item_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity_at_hand', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itemstocks = ItemStock::paginate($perPage);
        }

        return view('admin.item-stocks.index', compact('itemstocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-stocks.create');
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
        $this->validate($request, [
			'item_id' => 'required',
			'quantity_at_hand' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();
        
        ItemStock::create($requestData);

        return redirect('admin/item-stocks')->with('flash_message', 'ItemStock added!');
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
        $itemstock = ItemStock::findOrFail($id);

        return view('admin.item-stocks.show', compact('itemstock'));
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
        $itemstock = ItemStock::findOrFail($id);

        return view('admin.item-stocks.edit', compact('itemstock'));
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
        $this->validate($request, [
			'item_id' => 'required',
			'quantity_at_hand' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();
        
        $itemstock = ItemStock::findOrFail($id);
        $itemstock->update($requestData);

        return redirect('admin/item-stocks')->with('flash_message', 'ItemStock updated!');
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
        ItemStock::destroy($id);

        return redirect('admin/item-stocks')->with('flash_message', 'ItemStock deleted!');
    }
}
