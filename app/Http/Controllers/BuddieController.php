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

    public function view($id)
    {
        $this->authorize('buddies.view');

        $buddie = Buddie::find($id);

        return view('buddies.view', [
            'buddie' => $buddie
        ]);
    }
}
