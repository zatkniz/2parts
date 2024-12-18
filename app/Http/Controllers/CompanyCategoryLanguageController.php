<?php

namespace App\Http\Controllers;

use App\CompanyCategoryLanguage;
use App\Company;
use App\Category;
use App\Language;
use Illuminate\Http\Request;

class CompanyCategoryLanguageController extends Controller
{
    public function index()
    {
        return CompanyCategoryLanguage::get();
    }

    
    public function store(CompanyCategoryLanguage $companyCategoryLanguage)
    {
    $companyCategoryLanguage = CompanyCategoryLanguage::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $companyCategoryLanguage;
    }
    
    public function show(CompanyCategoryLanguage $companyCategoryLanguage)
    {
        return $companyCategoryLanguage;
    }

   
    public function destroy($companyCategoryLanguage)
    {
        return CompanyCategoryLanguage::where('id' , $companyCategoryLanguage)->delete();
    }
}
