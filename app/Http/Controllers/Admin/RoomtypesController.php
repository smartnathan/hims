<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomtypesController extends Controller
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
            $roomtypes = Roomtype::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $roomtypes = Roomtype::latest()->paginate($perPage);
        }

        return view('admin.roomtypes.index', compact('roomtypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.roomtypes.create');
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
        Roomtype::create($requestData);

        return redirect('admin/roomtypes')->with('flash_message', 'Roomtype added!');
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
        $roomtype = Roomtype::findOrFail($id);

        return view('admin.roomtypes.show', compact('roomtype'));
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
        $roomtype = Roomtype::findOrFail($id);

        return view('admin.roomtypes.edit', compact('roomtype'));
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

        $roomtype = Roomtype::findOrFail($id);
        $roomtype->update($requestData);

        return redirect('admin/roomtypes')->with('flash_message', 'Roomtype updated!');
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
        Roomtype::destroy($id);

        return redirect('admin/roomtypes')->with('flash_message', 'Roomtype deleted!');
    }
}
