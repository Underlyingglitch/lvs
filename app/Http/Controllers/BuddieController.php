<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BuddieController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $this->authorize('buddies.view');

        $buddies = User::role('buddie')->get();

        return view('buddies.index', [
            'buddies' => $buddies
        ]);
    }

    public function show($id)
    {
        $this->authorize('buddies.view');

        $buddie = User::find($id);

        return view('buddies.show', [
            'buddie' => $buddie
        ]);
    }

    public function edit($id)
    {
        $this->authorize('buddies.edit');

        $buddie = User::find($id);

        return view('buddies.edit', [
            'buddie' => $buddie
        ]);
    }

    public function update($id, Request $request)
    {
        $this->authorize('buddies.edit');

        abort_unless($request->hasValidSignature(), 401);

        $buddie = User::find($id);

        $buddie->group = $request->group;
        $buddie->studentid = $request->studentid;
        $buddie->email = $request->email;
        $buddie->name = $request->name;
        
        $buddie->save();

        return redirect()->route('buddies.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $this->authorize('buddies.delete');

        $buddie = User::find($id);

        return view('buddies.delete', [
            'buddie' => $buddie
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('buddies.delete');

        $buddie = User::find($id);

        $buddie->delete();

        return redirect()->view('buddies.index');
    }
}
