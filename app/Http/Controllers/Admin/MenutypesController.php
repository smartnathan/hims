<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Menutype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenutypesController extends Controller
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
            $menutypes = Menutype::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $menutypes = Menutype::latest()->paginate($perPage);
        }

        return view('admin.menutypes.index', compact('menutypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.menutypes.create');
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
			'description' => 'required'
		]);
        $requestData = $request->all();
        $requestData['added_by'] = Auth::user()->id;
        Menutype::create($requestData);

        return redirect('admin/menutypes')->with('flash_message', 'Menu category has been successfully added!');
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
        $menutype = Menutype::findOrFail($id);

        return view('admin.menutypes.show', compact('menutype'));
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
        $menutype = Menutype::findOrFail($id);

        return view('admin.menutypes.edit', compact('menutype'));
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
			'description' => 'required'
		]);
        $requestData = $request->all();

        $menutype = Menutype::findOrFail($id);
        $menutype->update($requestData);

        return redirect('admin/menutypes')->with('flash_message', 'Menu category has been successfully updated!');
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
        Menutype::destroy($id);

        return redirect('admin/menutypes')->with('flash_message', 'Menu category has been successfully deleted!');
    }
}
