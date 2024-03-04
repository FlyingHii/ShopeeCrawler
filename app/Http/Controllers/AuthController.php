<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {

        return view('auth.login');
    }


    /**
     * Login user from email and password
     *
     * */
    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect()->intended(route('products.list'));
        }

        return redirect(route('login'))->with('failed', 'Login failed');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save())
        {
            return redirect(route('login'))->with('success', 'User created successfully');
        }
        return redirect(route('register'))->with('error', 'Failed to create account');
    }

    /**
     * Logout user
     *
    */
    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}
