<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ItemBrand;
use App\ItemBrandManufacturer;
use Illuminate\Http\Request;

class ItemBrandsController extends Controller
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
            $itembrands = ItemBrand::where('item_brand_manufacturer_id', 'LIKE', "%$keyword%")
                ->orWhere('code', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itembrands = ItemBrand::paginate($perPage);
        }

        return view('admin.item-brands.index', compact('itembrands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $itembrandmanufacturers = ItemBrandManufacturer::select('id', 'name')->get()->pluck('name', 'id');
        $itembrandmanufacturers->prepend('--SELECT--', '');
        return view('admin.item-brands.create', compact('itembrandmanufacturers'));
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
			'item_brand_manufacturer_id' => 'required',
			'code' => 'required',
			'name' => 'required'
		]);
        $requestData = $request->all();

        ItemBrand::create($requestData);

        return redirect('admin/item-brands')->with('flash_message', 'ItemBrand added!');
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
        $itembrand = ItemBrand::findOrFail($id);

        return view('admin.item-brands.show', compact('itembrand'));
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
        $itembrand = ItemBrand::findOrFail($id);

        return view('admin.item-brands.edit', compact('itembrand'));
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
			'item_brand_manufacturer_id' => 'required',
			'code' => 'required',
			'name' => 'required'
		]);
        $requestData = $request->all();

        $itembrand = ItemBrand::findOrFail($id);
        $itembrand->update($requestData);

        return redirect('admin/item-brands')->with('flash_message', 'ItemBrand updated!');
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
        ItemBrand::destroy($id);

        return redirect('admin/item-brands')->with('flash_message', 'ItemBrand deleted!');
    }
}
