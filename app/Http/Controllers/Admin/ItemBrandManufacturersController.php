<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemBrandManufacturer;
use Illuminate\Http\Request;

class ItemBrandManufacturersController extends Controller
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
            $itembrandmanufacturers = ItemBrandManufacturer::where('name', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itembrandmanufacturers = ItemBrandManufacturer::paginate($perPage);
        }

        return view('admin.item-brand-manufacturers.index', compact('itembrandmanufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-brand-manufacturers.create');
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
			'name' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();
        
        ItemBrandManufacturer::create($requestData);

        return redirect('admin/item-brand-manufacturers')->with('flash_message', 'ItemBrandManufacturer added!');
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
        $itembrandmanufacturer = ItemBrandManufacturer::findOrFail($id);

        return view('admin.item-brand-manufacturers.show', compact('itembrandmanufacturer'));
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
        $itembrandmanufacturer = ItemBrandManufacturer::findOrFail($id);

        return view('admin.item-brand-manufacturers.edit', compact('itembrandmanufacturer'));
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
			'name' => 'required',
			'added_by' => 'required'
		]);
        $requestData = $request->all();
        
        $itembrandmanufacturer = ItemBrandManufacturer::findOrFail($id);
        $itembrandmanufacturer->update($requestData);

        return redirect('admin/item-brand-manufacturers')->with('flash_message', 'ItemBrandManufacturer updated!');
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
        ItemBrandManufacturer::destroy($id);

        return redirect('admin/item-brand-manufacturers')->with('flash_message', 'ItemBrandManufacturer deleted!');
    }
}
