<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('profile.index');
    }

    public function storepassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|different:current_password',
            'new_password_confirm' => 'required|same:new_password',
        ], [
            'new_password_confirm.same' => 'Nieuwe wachtwoorden komen niet overeen'
        ]);

        $user = User::find(auth()->user()->id);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect('/');
        }
        return redirect()->back()->withErrors(['current_password' => 'Huidige wachtwoord is onjuist']);
    }
}
