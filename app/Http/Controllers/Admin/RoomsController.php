<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Room;
use App\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
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
            $rooms = Room::where('name', 'LIKE', "%$keyword%")
                ->orWhere('roomtype_id', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('room_number', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('is_booked', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->orWhere('date_booked', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $rooms = Room::latest()->paginate($perPage);
        }

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roomtypes = Roomtype::select('id', 'name')->get();
        $roomtypes = $roomtypes->pluck('name', 'id');
        $roomtypes->prepend('--Select--', '');
        return view('admin.rooms.create', compact('roomtypes'));
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
        //dd($request->all());
        $this->validate($request, [
			'name' => 'required',
			'roomtype_id' => 'required',
			'description' => 'required',
			'price' => 'required',
		]);
        $requestData = $request->all();
        $requestData['added_by'] = Auth::user()->id;
        $fname = $requestData['fname'];
        $room = Room::create($requestData);
        $x = 0;
        foreach ($fname as $name) {
            $room_facility = new Facility();
            $room_facility->room_id = $room->id;
            $room_facility->name = $name;
            $room_facility->company_tag = $requestData['fcompany_tag'][$x];
            $room_facility->description = $requestData['fdescription'][$x];
            $room_facility->save();
            $x++;
        }
        return redirect('admin/rooms')->with('flash_message', 'Room added!');
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
        $room = Room::findOrFail($id);

        return view('admin.rooms.show', compact('room'));
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
        $room = Room::findOrFail($id);
        $roomtypes = Roomtype::select('id', 'name')->get();
        $roomtypes = $roomtypes->pluck('name', 'id');
        $roomtypes->prepend('--Select--', '');
        return view('admin.rooms.edit', compact('room', 'roomtypes'));
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
			'roomtype_id' => 'required',
			'description' => 'required',
			'price' => 'required'
		]);
        $requestData = $request->all();

        $room = Room::findOrFail($id);
        $room->update($requestData);

        return redirect('admin/rooms')->with('flash_message', 'Room updated!');
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
        Room::destroy($id);

        return redirect('admin/rooms')->with('flash_message', 'Room deleted!');
    }

}
