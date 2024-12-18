<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            ['email' => $request->input('password')], 
            [
                'username' => $request->input('userName'),
                'name' => $request->input('name'),
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
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return 'success';
    }

       public function getUser(User $user)
    {
        JavaScript::put([
            'employee' => $user,
        ]);
        return view('user-single');
    }
}
