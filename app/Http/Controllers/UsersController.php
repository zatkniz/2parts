<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return view('users');
    }

    public function registerUserView()
    {
        return view('register');
    }

       public function registerUser(Request $request)
    {
        $user = User::firstOrCreate(
            ['email' => $request->input('email')], 
            [
                'username' => $request->input('username'),
                'name' => $request->input('name'),
				'role' => $request->input('role'),
				'active' => $request->input('active'),
                'password' => Hash::make($request->input('password')),
            ]
        );
        return $user;
    }

    public function onlineUsers()
    {
        return User::where('id', '!=', Auth::id())->get();
    }

    public function allUsers()
    {
        return User::all();
    }

    public function getAuthUser()
    {
        return Auth::user();
    }

    public function saveUser(Request $request , User $user)
    {
        $user->name = $request->input('name');
        $user->active = $request->input('active');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $user;
    }

    public function getUser(User $user)
    {
        return $user;
    }
}
