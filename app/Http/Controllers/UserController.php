<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create', [
            'buddies' => User::role('buddie')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->studentid = $request->studentid;
        $user->group = $request->group;

        if ($request->type == "student" && $request->buddie != '--') {
            $user->buddie()->associate(User::find($request->buddie));
        }

        $password = Str::random(20);
        $user->password = Hash::make($password);

        $user->save();

        $user->assignRole($request->type);

        return view('users.create', [
            'buddies' => User::role('buddie')->get(),
            'user' => $user,
            'password' => $password
        ]);
    }

    public function changepassword(User $user)
    {
        // $user = User::find($id);
        $this->authorize('changepassword', $user);

        $new_password = Str::random(20);
        $user->password = Hash::make($new_password);

        $user->save();

        return redirect()->back()->with('success', 'Wachtwoord gewijzigd. Nieuwe wachtwoord: '.$new_password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
