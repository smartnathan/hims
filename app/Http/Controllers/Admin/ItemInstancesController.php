<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemInstance;
use Illuminate\Http\Request;

class ItemInstancesController extends Controller
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
            $iteminstances = ItemInstance::where('item_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('serial_number', 'LIKE', "%$keyword%")
                ->orWhere('item_brand_id', 'LIKE', "%$keyword%")
                ->orWhere('warranty_terms', 'LIKE', "%$keyword%")
                ->orWhere('expiry_date', 'LIKE', "%$keyword%")
                ->orWhere('date_manufactured', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $iteminstances = ItemInstance::paginate($perPage);
        }

        return view('admin.item-instances.index', compact('iteminstances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-instances.create');
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
			'expiry_date' => 'required',
			'date_manufactured' => 'required'
		]);
        $requestData = $request->all();
        
        ItemInstance::create($requestData);

        return redirect('admin/item-instances')->with('flash_message', 'ItemInstance added!');
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
        $iteminstance = ItemInstance::findOrFail($id);

        return view('admin.item-instances.show', compact('iteminstance'));
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
        $iteminstance = ItemInstance::findOrFail($id);

        return view('admin.item-instances.edit', compact('iteminstance'));
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
			'expiry_date' => 'required',
			'date_manufactured' => 'required'
		]);
        $requestData = $request->all();
        
        $iteminstance = ItemInstance::findOrFail($id);
        $iteminstance->update($requestData);

        return redirect('admin/item-instances')->with('flash_message', 'ItemInstance updated!');
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
        ItemInstance::destroy($id);

        return redirect('admin/item-instances')->with('flash_message', 'ItemInstance deleted!');
    }
}
