<?php

namespace App\Http\Controllers;

use Cache;
use Carbon\Carbon;
use App\Models\Buddie;
use App\Models\Leerling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LeerlingenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (Gate::allows('leerlingen.view')) {
            $leerlingen = Leerling::all();
        } else if (Gate::allows('leerlingen.viewown')) {
            $leerlingen = auth()->user()->buddie->leerlingen->all();
        } else {
            abort(403);
        }

        $leerlingen = Leerling::all();

        return view('leerlingen.index', [
            'leerlingen' => $leerlingen
        ]);
    }

    public function show($id)
    {
        $this->authorize('leerlingen.view');

        $leerling = Leerling::find($id);

        return view('leerlingen.show', [
            'leerling' => $leerling
        ]);
    }

    public function edit($id)
    {
        $this->authorize('leerlingen.edit');

        $leerling = Leerling::find($id);

        return view('leerlingen.edit', [
            'leerling' => $leerling,
            'buddies' => Buddie::all()
        ]);
    }

    public function update($id, Request $request)
    {
        $this->authorize('leerlingen.edit');

        abort_unless($request->hasValidSignature(), 401);

        $leerling = Leerling::find($id);

        $leerling->klas = $request->klas;
        $leerling->leerlingnummer = $request->leerlingnummer;
        $leerling->user->email = $request->email;
        $leerling->user->name = $request->name;

        if ($request->buddie != 'none') {
            $leerling->buddie_id = $request->buddie;
        } else {
            $leerling->buddie_id = null;
        }
        
        $leerling->user->save();
        $leerling->save();

        return redirect()->route('leerlingen.show', ['id' => $id]);
    }

    public function delete($id)
    {
        $this->authorize('leerlingen.delete');

        $leerling = Leerling::find($id);

        return view('leerlingen.delete', [
            'leerling' => $leerling
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('leerlingen.delete');

        $buddie = Leerling::find($id);

        $buddie->delete();

        return redirect()->view('leerlingen.index');
    }
}
