<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoriesController extends Controller
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
            $itemcategories = ItemCategory::where('code', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itemcategories = ItemCategory::paginate($perPage);
        }

        return view('admin.item-categories.index', compact('itemcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-categories.create');
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
			'code' => 'required'
		]);
        $requestData = $request->all();
        
        ItemCategory::create($requestData);

        return redirect('admin/item-categories')->with('flash_message', 'ItemCategory added!');
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
        $itemcategory = ItemCategory::findOrFail($id);

        return view('admin.item-categories.show', compact('itemcategory'));
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
        $itemcategory = ItemCategory::findOrFail($id);

        return view('admin.item-categories.edit', compact('itemcategory'));
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
			'code' => 'required'
		]);
        $requestData = $request->all();
        
        $itemcategory = ItemCategory::findOrFail($id);
        $itemcategory->update($requestData);

        return redirect('admin/item-categories')->with('flash_message', 'ItemCategory updated!');
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
        ItemCategory::destroy($id);

        return redirect('admin/item-categories')->with('flash_message', 'ItemCategory deleted!');
    }
}
