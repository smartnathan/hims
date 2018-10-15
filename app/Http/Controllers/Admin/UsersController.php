<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Lga;
use App\Nationality;
use App\Occupation;
use App\Role;
use App\Room;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

// public function __construct()
// {
//     $this->authorizeResource(User::class);
// }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $this->authorize('view-all-user');

        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $users = User::where('surname', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->orWhere('mobile_number', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
            $guests = Role::where('name', 'guest')->get();
        }

        return view('admin.users.index', compact('bookings','users', 'guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $this->authorize('create-user');
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        $occupations = Occupation::select('id', 'name')->get()
        ->pluck('name', 'id');
        $occupations->prepend('--Select--', '');
        $states = State::select('id', 'name')->get()
        ->pluck('name', 'id');
        $states->prepend('--Select--', '');
        $nationalities = Nationality::select('id', 'name')->get()
        ->pluck('name', 'id');
        $nationalities->prepend('--Select--', '');
        $occupations->prepend('--Select--', '');
        return view('admin.users.create', compact('nationalities', 'states', 'roles', 'occupations'));
    }

    public function lga(Request $request)
    {
        $id = $request->get('state_id');
        $lgas = Lga::where('state_id', $id)->get();
       return $lgas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->authorize('create-user');
        if (Auth::user()->hasRole('admin')) {
            $this->validate($request, [
            'firstname' => 'required',
            'surname' => 'required',
            'othername' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'mobile_number' => 'required|unique:users,mobile_number',
             'roles' => 'required'
        ]);

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $data['added_by'] = Auth::user()->id;
        $user = User::create($data);

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'Staff was sucessfully created')->with('user_email', $user->email);
        }
        else {
            $this->validate($request, [
            'firstname' => 'required',
            'surname' => 'required',
            'othername' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'state_id' => 'required',
            //'lga_id' => ''
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|unique:users,mobile_number',
        ]);
        $data = $request->except('password');
        $data['password'] = bcrypt($request->mobile_number);
        $data['username'] = $request->mobile_number;
        $data['added_by'] = Auth::user()->id;
        $user = User::create($data);
        $user->assignRole('guest');
        return redirect('admin/users')->with('flash_message', 'Guest was successfully added');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $this->authorize('view-user');
        $user = User::findOrFail($id);
        $rooms = Room::where('is_booked', 0)->get();
        return view('admin.users.show', compact('user', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $this->authorize('update-user');
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');
        $occupations = Occupation::select('id', 'name')->get()
        ->pluck('name', 'id');
        $occupations->prepend('--Select--', '');
        $states = State::select('id', 'name')->get()
        ->pluck('name', 'id');
        $states->prepend('--Select--', '');
        $nationalities = Nationality::select('id', 'name')->get()
        ->pluck('name', 'id');
        $nationalities->prepend('--Select--', '');

        $user = User::with('roles')->select('id',
            'firstname',
            'othername',
            'mobile_number',
            'surname',
            'address',
            'lga_id',
            'occupation_id',
            'username',
            'gender',
            'nationality_id',
            'designation',
             'email')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        return view('admin.users.edit', compact('nationalities', 'occupations', 'states','user', 'roles', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update-user');
        $this->validate($request, [
            'firstname' => 'required',
            'othername' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'mobile_number' => 'required'
        ]);

        $data = $request->except('password');
        if ($request->has('password') && $request->password != null) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        if (Auth::user()->hasRole('admin')) {
            $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }
        }

        return redirect('admin/users')->with('flash_message', 'The user was succesfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->authorize('delete-user');
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }


}
