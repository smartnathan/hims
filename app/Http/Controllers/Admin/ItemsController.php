<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Item;
use App\ItemBrand;
use App\ItemCategory;
use App\ItemGroup;
use App\ItemUom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
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
            $items = Item::where('item_category_id', 'LIKE', "%$keyword%")
                ->orWhere('item_brand_id', 'LIKE', "%$keyword%")
                ->orWhere('item_group_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('code', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('has_instances', 'LIKE', "%$keyword%")
                ->orWhere('is_active', 'LIKE', "%$keyword%")
                ->orWhere('tag', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->orWhere('oem', 'LIKE', "%$keyword%")
                ->orWhere('warranty_terms', 'LIKE', "%$keyword%")
                ->orWhere('model_number', 'LIKE', "%$keyword%")
                ->orWhere('item_uom_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $items = Item::paginate($perPage);
        }

        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $itemCategories = ItemCategory::select('id', 'name')
        ->get()->pluck('name', 'id')->prepend('--SELECT--', '');
        $itemBrand = ItemBrand::select('id', 'name')
        ->get()->pluck('name', 'id')->prepend('--SELECT--', '');
        $itemGroup = ItemGroup::select('id', 'name')->get()
        ->pluck('name', 'id')->prepend('--SELECT--', '');
        $itemUom = ItemUom::select('id', 'name')->get()
        ->pluck('name', 'id')->prepend('--SELECT--', '');
        return view('admin.items.create', compact('itemUom', 'itemGroup', 'itemCategories', 'itemBrand'));
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
			'item_brand_id' => 'required',
			'has_instances' => 'required',
			'is_active' => 'required',
            'tag' => 'required',
            'quantity' => 'required',
            'oem' => 'required'
		]);
        $requestData = $request->all();
        $requestData['added_by'] = Auth::user()->id;
        Item::create($requestData);
        return redirect('admin/items')->with('flash_message', 'Item was successfully added!');
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
        $item = Item::findOrFail($id);

        return view('admin.items.show', compact('item'));
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
        $item = Item::findOrFail($id);

        return view('admin.items.edit', compact('item'));
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
			'item_brand_id' => 'required',
			'has_instances' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();

        $item = Item::findOrFail($id);
        $item->update($requestData);

        return redirect('admin/items')->with('flash_message', 'Item updated!');
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
        Item::destroy($id);

        return redirect('admin/items')->with('flash_message', 'Item deleted!');
    }
}
