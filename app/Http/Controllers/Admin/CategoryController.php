<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = new Category();
        return view('admin.categories.create', compact('category'));
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
        $category = Category::Create([
            'title' => $req->title, 
            'slug' => $req->slug, 
        ]);

        if ($req->hasFile('image') && $req->file('image')->isValid()) {
            $category->clearMediaCollection();
            $category->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect(route('admin.categories.edit', $category->id));
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
        $category = Category::findOrFail($id);

        $mediaItem = $category->getFirstMedia('images');
        $file_name = !empty($mediaItem) ? $mediaItem->file_name : '';

        return view('admin.categories.edit', compact('category', 'file_name'));
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
        $category = Category::findOrFail($id);

        $category->title  = $req->title;
        $category->slug = $req->slug;
        $category->save();

        if ($req->hasFile('image') && $req->file('image')->isValid()) {
            $category->clearMediaCollection();
            $category->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect(route('admin.categories.edit', $category->id));
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
        $category = Category::findOrFail($req->target);
        $category->clearMediaCollection('images');

        return redirect(route('admin.categories.edit', $category->id));
    }
}