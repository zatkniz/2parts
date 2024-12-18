<?php

namespace App\Http\Controllers;

use App\Models\Frame;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function customerFrames(Request $request){
        $frames = Frame::whereHas('fund', function (Builder $query) use ($request) {
            if($request->input('searchInCurrentCustomer')){
                $query->whereCustomerId($request->input('customer_id'));
            }
        });

        $returnValue = [];
        $returnValue['names'] = $frames->select('name')->whereNotNull('name')->distinct()->get();
        $returnValue['car_numbers'] = $frames->select('car_number')->whereNotNull('car_number')->distinct()->get();
        $returnValue['brands'] = $frames->select('brand')->whereNotNull('brand')->distinct()->get();
        $returnValue['models'] = $frames->select('model')->whereNotNull('model')->distinct()->get();

        return $returnValue;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function show(Frame $frame)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function edit(Frame $frame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frame $frame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frame $frame)
    {
        //
    }
}
