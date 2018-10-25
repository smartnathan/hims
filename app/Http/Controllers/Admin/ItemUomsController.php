<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemUom;
use Illuminate\Http\Request;

class ItemUomsController extends Controller
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
            $itemuoms = ItemUom::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itemuoms = ItemUom::paginate($perPage);
        }

        return view('admin.item-uoms.index', compact('itemuoms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-uoms.create');
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
        
        $requestData = $request->all();
        
        ItemUom::create($requestData);

        return redirect('admin/item-uoms')->with('flash_message', 'ItemUom added!');
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
        $itemuom = ItemUom::findOrFail($id);

        return view('admin.item-uoms.show', compact('itemuom'));
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
        $itemuom = ItemUom::findOrFail($id);

        return view('admin.item-uoms.edit', compact('itemuom'));
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
        
        $requestData = $request->all();
        
        $itemuom = ItemUom::findOrFail($id);
        $itemuom->update($requestData);

        return redirect('admin/item-uoms')->with('flash_message', 'ItemUom updated!');
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
        ItemUom::destroy($id);

        return redirect('admin/item-uoms')->with('flash_message', 'ItemUom deleted!');
    }
}
