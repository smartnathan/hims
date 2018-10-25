<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemPurchaseOrder;
use Illuminate\Http\Request;

class ItemPurchaseOrdersController extends Controller
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
            $itempurchaseorders = ItemPurchaseOrder::where('item_supplier_id', 'LIKE', "%$keyword%")
                ->orWhere('purchase_date', 'LIKE', "%$keyword%")
                ->orWhere('total_amount', 'LIKE', "%$keyword%")
                ->orWhere('is_paid', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itempurchaseorders = ItemPurchaseOrder::paginate($perPage);
        }

        return view('admin.item-purchase-orders.index', compact('itempurchaseorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-purchase-orders.create');
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
			'item_supplier_id' => 'required',
			'purchase_date' => 'required',
			'total_amount' => 'required',
			'is_paid' => 'required'
		]);
        $requestData = $request->all();
        
        ItemPurchaseOrder::create($requestData);

        return redirect('admin/item-purchase-orders')->with('flash_message', 'ItemPurchaseOrder added!');
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
        $itempurchaseorder = ItemPurchaseOrder::findOrFail($id);

        return view('admin.item-purchase-orders.show', compact('itempurchaseorder'));
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
        $itempurchaseorder = ItemPurchaseOrder::findOrFail($id);

        return view('admin.item-purchase-orders.edit', compact('itempurchaseorder'));
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
			'item_supplier_id' => 'required',
			'purchase_date' => 'required',
			'total_amount' => 'required',
			'is_paid' => 'required'
		]);
        $requestData = $request->all();
        
        $itempurchaseorder = ItemPurchaseOrder::findOrFail($id);
        $itempurchaseorder->update($requestData);

        return redirect('admin/item-purchase-orders')->with('flash_message', 'ItemPurchaseOrder updated!');
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
        ItemPurchaseOrder::destroy($id);

        return redirect('admin/item-purchase-orders')->with('flash_message', 'ItemPurchaseOrder deleted!');
    }
}
