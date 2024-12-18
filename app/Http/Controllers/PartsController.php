<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;

class PartsController extends Controller
{
    public function all()
    {
        return Part::orderBy('name')->get();
    }

    public function quickSearch(Request $request)
    {
        return Part::where('name' , 'like' , '%'.$request->input('name').'%')->get();
    }
}
