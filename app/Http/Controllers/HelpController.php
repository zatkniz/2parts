<?php

namespace App\Http\Controllers;

use App\Help;
use App\HelpBody;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Help::with('helpBody')->get();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Help::query()->delete();
        HelpBody::query()->delete();
        $helps = collect($request->all());
        return $helps->map(function($help) {
            $order = Help::updateOrCreate(
                ['id' => isset($help['id']) ? $help['id'] : null],
                $help
            );

            collect($help['help_body'])->map(function($body, $index) use ($order){
                $companyCategory = HelpBody::updateOrCreate(['id' => array_key_exists('id', $body) ? $body['id'] : null],[
                    'description' => $body['description'],
                    'name' => $body['name'],
                    'help_id' => $order->id
                ]);
            });
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function show(Help $help)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function edit(Help $help)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Help $help)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function destroy(Help $help)
    {
        //
    }
}
