<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        $attributes = request()->validate([
            'name' => 'required|max:255|min:3',
            'username' => 'required|max:255|min:2|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7',
        ]);
        $attributes['password'] = bcrypt($attributes['password']);

        $user= User::create($attributes);

        auth()->login($user);

        session()->flash('success', 'account aangemaakt');

        return redirect('/');
    }
}
