<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemSupplier;
use Illuminate\Http\Request;

class ItemSuppliersController extends Controller
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
            $itemsuppliers = ItemSupplier::where('code', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itemsuppliers = ItemSupplier::paginate($perPage);
        }

        return view('admin.item-suppliers.index', compact('itemsuppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-suppliers.create');
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
			'code' => 'required',
			'name' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();
        
        ItemSupplier::create($requestData);

        return redirect('admin/item-suppliers')->with('flash_message', 'ItemSupplier added!');
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
        $itemsupplier = ItemSupplier::findOrFail($id);

        return view('admin.item-suppliers.show', compact('itemsupplier'));
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
        $itemsupplier = ItemSupplier::findOrFail($id);

        return view('admin.item-suppliers.edit', compact('itemsupplier'));
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
			'code' => 'required',
			'name' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();
        
        $itemsupplier = ItemSupplier::findOrFail($id);
        $itemsupplier->update($requestData);

        return redirect('admin/item-suppliers')->with('flash_message', 'ItemSupplier updated!');
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
        ItemSupplier::destroy($id);

        return redirect('admin/item-suppliers')->with('flash_message', 'ItemSupplier deleted!');
    }
}
