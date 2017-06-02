<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class RegistrationController extends Controller
    {

        public function create()
        {
            return view('registration.create');
        }

        public function store()
        {
            $this->validate(request(), [
                "name" => "required",
                "email" => "required|email",
                "password" => "required|confirmed",
            ]);

            $user = new \App\User;
            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->save();

            auth()->login($user);

            return redirect()->home();
        }

    }
    