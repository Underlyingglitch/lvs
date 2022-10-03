<?php

namespace App\Http\Controllers;

use App\Models\Buddie;
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

        $buddies = Buddie::all();

        return view('buddies.index', [
            'buddies' => $buddies
        ]);
    }

    public function show(Buddie $id)
    {
        $this->authorize('buddies.view');

        return view('buddies.show', [
            'buddie' => $id
        ]);
    }

    public function edit(Buddie $id)
    {
        $this->authorize('buddies.edit');

        return view('buddies.edit', [
            'buddie' => $id
        ]);
    }

    public function update($id, Request $request)
    {
        $this->authorize('buddies.edit');

        abort_unless($request->hasValidSignature(), 401);

        $buddie = Buddie::find($id);

        $buddie->klas = $request->klas;
        $buddie->leerlingnummer = $request->leerlingnummer;
        $buddie->user->email = $request->email;
        $buddie->user->name = $request->name;
        
        $buddie->user->save();
        $buddie->save();

        return redirect()->route('buddies.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $this->authorize('buddies.delete');

        $buddie = Buddie::find($id);

        return view('buddies.delete', [
            'buddie' => $buddie
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('buddies.delete');

        $buddie = Buddie::find($id);

        $buddie->delete();

        return redirect()->view('buddies.index');
    }
}
