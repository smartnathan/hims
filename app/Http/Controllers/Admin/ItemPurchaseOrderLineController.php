<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemPurchaseOrderLine;
use Illuminate\Http\Request;

class ItemPurchaseOrderLineController extends Controller
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
            $itempurchaseorderline = ItemPurchaseOrderLine::where('item_purchase_order_id', 'LIKE', "%$keyword%")
                ->orWhere('item_id', 'LIKE', "%$keyword%")
                ->orWhere('unit_price', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itempurchaseorderline = ItemPurchaseOrderLine::paginate($perPage);
        }

        return view('admin.item-purchase-order-line.index', compact('itempurchaseorderline'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-purchase-order-line.create');
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
			'item_purchase_order_id' => 'required',
			'item_id' => 'required',
			'unit_price' => 'required'
		]);
        $requestData = $request->all();
        
        ItemPurchaseOrderLine::create($requestData);

        return redirect('admin/item-purchase-order-line')->with('flash_message', 'ItemPurchaseOrderLine added!');
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
        $itempurchaseorderline = ItemPurchaseOrderLine::findOrFail($id);

        return view('admin.item-purchase-order-line.show', compact('itempurchaseorderline'));
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
        $itempurchaseorderline = ItemPurchaseOrderLine::findOrFail($id);

        return view('admin.item-purchase-order-line.edit', compact('itempurchaseorderline'));
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
			'item_purchase_order_id' => 'required',
			'item_id' => 'required',
			'unit_price' => 'required'
		]);
        $requestData = $request->all();
        
        $itempurchaseorderline = ItemPurchaseOrderLine::findOrFail($id);
        $itempurchaseorderline->update($requestData);

        return redirect('admin/item-purchase-order-line')->with('flash_message', 'ItemPurchaseOrderLine updated!');
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
        ItemPurchaseOrderLine::destroy($id);

        return redirect('admin/item-purchase-order-line')->with('flash_message', 'ItemPurchaseOrderLine deleted!');
    }
}
