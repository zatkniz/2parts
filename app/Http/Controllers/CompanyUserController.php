<?php

namespace App\Http\Controllers;

use App\CompanyUser;
use App\Company;
use App\User;
use Illuminate\Http\Request;

class CompanyUserController extends Controller
{
    public function index()
    {
        return CompanyUser::get();
    }

    
    public function store(CompanyUser $companyUser)
    {
    $companyUser = CompanyUser::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $companyUser;
    }
    
    public function show(CompanyUser $companyUser)
    {
        return $companyUser;
    }

   
    public function destroy($companyUser)
    {
        return CompanyUser::where('id' , $companyUser)->delete();
    }
}
