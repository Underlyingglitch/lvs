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
        $this->authorize('viewAny', User::class);

        $buddies = User::all()->where('role', '=', 'buddie');

        return view('buddies.index', [
            'buddies' => $buddies
        ]);
    }

    public function show(User $buddie)
    {
        $this->authorize('view', $buddie);

        return view('buddies.show', [
            'buddie' => $buddie
        ]);
    }

    public function edit(User $buddie)
    {
        $this->authorize('update', $buddie);

        return view('buddies.edit', [
            'buddie' => $buddie
        ]);
    }

    public function update(User $buddie, Request $request)
    {
        abort_unless($request->hasValidSignature(), 401);
        $this->authorize('update', $buddie);

        $buddie->group = $request->group;
        $buddie->studentid = $request->studentid;
        $buddie->email = $request->email;
        $buddie->name = $request->name;
        
        $buddie->save();

        return redirect()->route('buddies.show', ['buddie' => $buddie->id]);
    }

    public function delete(User $buddie)
    {
        $this->authorize('delete', $buddie);

        return view('buddies.delete', [
            'buddie' => $buddie
        ]);
    }

    public function destroy(User $buddie)
    {
        $this->authorize('delete', $buddie);

        $buddie->delete();

        return redirect()->view('buddies.index');
    }
}
