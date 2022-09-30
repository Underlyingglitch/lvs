<?php

namespace App\Http\Controllers;

use Cache;
use Carbon\Carbon;
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
            abort(403, 'Geen rechten');
        }

        $leerlingen = Leerling::all();

        return view('leerlingen.index', [
            'leerlingen' => $leerlingen
        ]);
    }

    public function view($id)
    {
        $this->authorize('leerlingen.view');

        $leerling = Leerling::find($id);

        return view('leerlingen.view', [
            'leerling' => $leerling
        ]);
    }
}
