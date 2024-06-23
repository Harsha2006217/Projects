<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Concerns\InteractsWithInput;
use Illuminate\Http\Request;

class sessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email|min:5|max:150',
            'password' => 'required|min:5|string|max:150'
        ]);

        if(auth()-> attempt($attributes)){
            session()->regenerate();
            return redirect('/')->with('succses', 'Je bent ingelogd');
        }

        return back()
        ->withInput()->
        withErrors(['email' => 'Geen gebruiker gevonden met deze gegevens']);
    }


    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'doei!');
    }
}
