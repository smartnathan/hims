<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ItemGroup;
use Illuminate\Http\Request;

class ItemGroupsController extends Controller
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
            $itemgroups = ItemGroup::where('code', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $itemgroups = ItemGroup::paginate($perPage);
        }

        return view('admin.item-groups.index', compact('itemgroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-groups.create');
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        ItemGroup::create($requestData);

        return redirect('admin/item-groups')->with('flash_message', 'ItemGroup added!');
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
        $itemgroup = ItemGroup::findOrFail($id);

        return view('admin.item-groups.show', compact('itemgroup'));
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
        $itemgroup = ItemGroup::findOrFail($id);

        return view('admin.item-groups.edit', compact('itemgroup'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $itemgroup = ItemGroup::findOrFail($id);
        $itemgroup->update($requestData);

        return redirect('admin/item-groups')->with('flash_message', 'ItemGroup updated!');
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
        ItemGroup::destroy($id);

        return redirect('admin/item-groups')->with('flash_message', 'ItemGroup deleted!');
    }
}
