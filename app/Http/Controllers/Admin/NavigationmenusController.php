<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Navigationmenu;
use Illuminate\Http\Request;

class NavigationmenusController extends Controller
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
            $navigationmenus = Navigationmenu::where('name', 'LIKE', "%$keyword%")
                ->orWhere('url', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $navigationmenus = Navigationmenu::paginate($perPage);
        }

        return view('admin.navigationmenus.index', compact('navigationmenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.navigationmenus.create');
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
        
        Navigationmenu::create($requestData);

        return redirect('admin/navigationmenus')->with('flash_message', 'Navigationmenu added!');
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
        $navigationmenu = Navigationmenu::findOrFail($id);

        return view('admin.navigationmenus.show', compact('navigationmenu'));
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
        $navigationmenu = Navigationmenu::findOrFail($id);

        return view('admin.navigationmenus.edit', compact('navigationmenu'));
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
        
        $navigationmenu = Navigationmenu::findOrFail($id);
        $navigationmenu->update($requestData);

        return redirect('admin/navigationmenus')->with('flash_message', 'Navigationmenu updated!');
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
        Navigationmenu::destroy($id);

        return redirect('admin/navigationmenus')->with('flash_message', 'Navigationmenu deleted!');
    }
}
