<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Serviceorder;
use Illuminate\Http\Request;

class ServiceordersController extends Controller
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
            $serviceorders = Serviceorder::where('service_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('added_by', 'LIKE', "%$keyword%")
                ->orWhere('paid', 'LIKE', "%$keyword%")
                ->orWhere('payment_type_id', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $serviceorders = Serviceorder::paginate($perPage);
        }

        return view('admin.serviceorders.index', compact('serviceorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.serviceorders.create');
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
			'quantity' => 'required'
		]);
        $requestData = $request->all();
        
        Serviceorder::create($requestData);

        return redirect('admin/serviceorders')->with('flash_message', 'Serviceorder added!');
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
        $serviceorder = Serviceorder::findOrFail($id);

        return view('admin.serviceorders.show', compact('serviceorder'));
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
        $serviceorder = Serviceorder::findOrFail($id);

        return view('admin.serviceorders.edit', compact('serviceorder'));
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
			'quantity' => 'required'
		]);
        $requestData = $request->all();
        
        $serviceorder = Serviceorder::findOrFail($id);
        $serviceorder->update($requestData);

        return redirect('admin/serviceorders')->with('flash_message', 'Serviceorder updated!');
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
        Serviceorder::destroy($id);

        return redirect('admin/serviceorders')->with('flash_message', 'Serviceorder deleted!');
    }
}
