<?php

namespace App\Http\Controllers;

use App\Scan;
use Illuminate\Http\Request;

class ScansController extends Controller
{
    public function index()
    {
        return Scan::get();
    }

    
    public function store(Request $request)
    {
    $scan = Scan::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $scan;
    }
    
    public function show(Scan $scan)
    {
        return $scan;
    }

   
    public function destroy($scan)
    {
        return Scan::where('id' , $scan)->delete();
    }
}
