<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $regions = Region::all();

        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $region = new Region();
        return view('admin.regions.create', compact('region'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //
        $region = Region::Create([
            'name' => $req->name, 
            'code' => $req->code, 
        ]);

        // if ($req->hasFile('image') && $req->file('image')->isValid()) {
        //     $region->clearMediaCollection();
        //     $region->addMediaFromRequest('image')->toMediaCollection('images');
        // }

        return redirect(route('admin.regions.edit', $region->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $region = Region::findOrFail($id);

        // $mediaItem = $region->getFirstMedia('images');
        // $file_name = !empty($mediaItem) ? $mediaItem->file_name : '';

        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
        $region = Region::findOrFail($id);

        $region->name  = $req->name;
        $region->code = $req->code;
        $region->save();

        // if ($req->hasFile('image') && $req->file('image')->isValid()) {
        //     $region->clearMediaCollection();
        //     $region->addMediaFromRequest('image')->toMediaCollection('images');
        // }

        return redirect(route('admin.regions.edit', $region->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function image_delete(Request $req)
    {
        //
        $region = Region::findOrFail($req->target);
        $region->clearMediaCollection('images');

        return redirect(route('admin.regions.edit', $region->id));
    }
}