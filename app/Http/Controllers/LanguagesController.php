<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function index()
    {
        return Language::get();
    }

    
    public function store(Language $language)
    {
    $language = Language::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $language;
    }
    
    public function show(Language $language)
    {
        return $language;
    }

   
    public function destroy($language)
    {
        return Language::where('id' , $language)->delete();
    }
}