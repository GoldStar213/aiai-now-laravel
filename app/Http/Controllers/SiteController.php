<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Region;
use App\Models\Service;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $regions = Region::all();

        $recent_services = Service::orderByDesc('created_at')->where('published', true)->get()->slice(0, 3);

        $services = [];
        $services[] = Service::with('category', 'region')->orderByDesc('created_at')->where('published', true)->get()->slice(0, 10);
        $services[] = Service::with('category', 'region')->orderByDesc('likes')->where('published', true)->get()->slice(0, 10);
        $services[] = Service::with('category', 'region')->orderByDesc('rating')->where('published', true)->get()->slice(0, 10);

        $slugs = [];
        $slugs = 'sort=recent';
        $slugs = 'sort=ranking';
        $slugs = 'sort=point';

        return view('front.home', compact('services', 'slugs', 'recent_services', 'categories', 'regions'));
    }

    public function profile()
    {
        return view('profile');
    }
}
