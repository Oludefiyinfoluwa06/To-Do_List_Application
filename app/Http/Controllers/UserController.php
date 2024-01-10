<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register_page () {
        if (session()->has('email')) {
            return redirect('/');
        }

        return view('register');

    }

    public function login_page () {
        if (session()->has('email')) {
            return redirect('/');
        }

        return view('login');

    }

    public function register (Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if ($user) {
            return redirect('/login')->with('message', 'User created successfully');
        }
    }

    public function login (Request $request) {
        $credentials = [
            'email'    =>  $request->email,
            'password' =>  $request->password
        ];

        $user = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($credentials)) {
            session()->put('email', $user->email);

            return redirect('/')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Incorrect email or password');
    }

    public function logout () {
        session()->forget('email');

        if (session()->has('email')) {
            return redirect('/');
        }
        
        return redirect('/login');
        
    }

    public function view_profile () {
        if (!session()->has('email')) {
            return redirect('/login');
        }

        $email = session()->get('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            $username = $user->name;
            $email = $user->email;
        } else {
            return redirect('/login');
        }
        return view("profile", [
            'username' => $username,
            'email' => $email
        ]);
    }

    public function edit () {
        if (!session()->has('email')) {
            return redirect('/login');
        }

        $email = session()->get('email');
        $user = User::where('email', $email)->first();

        $username = $user->name;
        $email = $user->email;

        return view('edit_profile', [
            'username' => $username,
            'email' => $email
        ]);
        
    }

    public function edit_profile (Request $request) {
        if (!session()->has('email')) {
            return redirect('/login');
        }
        
        $email = session()->get('email');
        $user = User::where('email', $email)->first();
        $input = $request->all();
        $user->update($input);
        session()->forget('email');
        session()->put('email', $user->email);
        return redirect('/profile')->with('profile_edit_success', 'Profile update successful');
    }
}
