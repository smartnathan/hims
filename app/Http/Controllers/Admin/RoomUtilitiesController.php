<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\RoomUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomUtilitiesController extends Controller
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
            $roomutilities = RoomUtility::where('name', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $roomutilities = RoomUtility::latest()->paginate($perPage);
        }

        return view('admin.room-utilities.index', compact('roomutilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.room-utilities.create');
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
		]);
        $requestData = $request->all();
        $requestData['added_by'] = Auth::user()->id;
        $room_utilities = RoomUtility::create($requestData);
        if ($request->ajax()) {
            return response()->json($room_utilities);
        } else {
            return redirect('admin/room-utilities')->with('flash_message', 'Room Utility was successfully added!');

        }
        

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
        $roomutility = RoomUtility::findOrFail($id);

        return view('admin.room-utilities.show', compact('roomutility'));
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
        $roomutility = RoomUtility::findOrFail($id);

        return view('admin.room-utilities.edit', compact('roomutility'));
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
		]);
        $requestData = $request->all();

        $roomutility = RoomUtility::findOrFail($id);
        $roomutility->update($requestData);

        return redirect('admin/room-utilities')->with('flash_message', 'Room Utility was successfully updated!');
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
        RoomUtility::destroy($id);

        return redirect('admin/room-utilities')->with('flash_message', 'RoomUtility deleted!');
    }
}
