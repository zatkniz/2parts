<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
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

    public function uploadLogo(Request $request) {
        $request->validate([
            'photo' => 'required|file|image',
        ]);

        return $newPath = $request->photo->store('logos', ['disk' => 'public']);
    }

    public function uploadPdf(Request $request) {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10000',
        ]);

        return $newPath = $request->pdf->storeAs('pdf', $request->pdf->getClientOriginalName(), 'public');
    }

    public function uploadCompanyImages(Request $request) {
        $request->validate([
            'photo' => 'required|file|mimes:jpeg,png,bmp,gif,svg,mp4,ogx,oga,ogv,ogg,webm,pdf',
        ]);

        return $newPath = $request->photo->storeAs('company/images', $request->photo->getClientOriginalName(), 'public');
    }

    public function uploadCategoryIcon(Request $request) {
        return $newPath = $request->photo->storeAs('category/icon', $request->photo->getClientOriginalName(), 'public');
    }

    public function uploadProductImages(Request $request) {
        $request->validate([
            'photo' => 'required|file|mimes:jpeg,png,bmp,gif,svg,mp4,ogx,oga,ogv,ogg,webm,pdf',
        ]);
        // return $request->photo->getClientOriginalName();
        return $newPath = $request->photo->storeAs('product/images', $request->photo->getClientOriginalName(), 'public');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Media::updateOrCreate(
            ['url' => $request->path],
            $request->all()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
