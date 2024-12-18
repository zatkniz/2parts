<?php

namespace App\Http\Controllers;

use App\CompanyKind;
use Illuminate\Http\Request;

class CompanyKindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyKind::all();
    }

    public function allWithCount() {
        return CompanyKind::withCount('company as count')->get();
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
        $companyKind = CompanyKind::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );
        return $companyKind;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyKind  $companyKind
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyKind $companyKind)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyKind  $companyKind
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyKind $companyKind)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyKind  $companyKind
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyKind $companyKind)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyKind  $companyKind
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyKind $companyKind)
    {
        return $companyKind->delete();
    }
}
