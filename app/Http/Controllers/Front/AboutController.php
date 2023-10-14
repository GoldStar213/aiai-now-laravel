<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Category;

class AboutController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();

        return view('front.about.index', compact('categories'));
    }
}
