<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show Register form

    public function create(){
        return view('users.register');
    }



    //create New user
    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>['required','min:3'],
            'password'=>'required|confirmed|min:6'
        ]);
        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        
        //create User
        $user = User::create($formFields);


        //Login
        auth()->login($user);
        return redirect('/')->with('message','User created and logged in');
    }

    
}


