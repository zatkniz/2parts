<?php

namespace App\Http\Controllers;

use App\UserRole;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    public function index()
    {
        return UserRole::get();
    }


    
    public function store(Request $request)
    {
        //
    }

    
    public function show(UserRole $userRole)
    {
        return $userRole;
    }

    public function destroy(UserRole $userRole)
    {
        //
    }
}
