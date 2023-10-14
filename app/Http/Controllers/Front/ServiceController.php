<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Region;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();
        $regions = Region::all();

        if (!empty($req)) {
            $services = Service::query();

            $services = $services->where('published', true);

            if (!empty($req->cat)) {
                $services = $services->where('category_id', $req->cat)->get();
            } else if (!empty($req->region)) {
                $services = $services->where('region_id', $req->region)->get();
            } else if (!empty($req->keyword)) {
                $services = $services->where('title', 'like', '%' . $req->keyword . '%')->
                                orWhere('content', 'like', '%' . $req->keyword . '%')->get();
            } else if (!empty($req->orig_id)) {
                $services = $services->where('original_id', 'like', '%' . strtolower($req->orig_id) . '%')->get();
            } else {
                $services = $services->get();
            }

            if (!empty($req->sort)) {
                if ($req->sort == 'ranking') {
                    $services = $services->sortBy([[ 'likes', 'desc' ]]);
                } else if ($req->sort == 'recent') {
                    $services = $services->sortBy([[ 'created_at', 'desc' ]]);
                } else if ($req->sort == 'point') {
                    $services = $services->sortBy([[ 'rating', 'desc' ]]);
                }
            }

            $count = $services->count();

            $services = $services->paginate(20)->onEachSide(0);
        }

        return view('front.services.index', compact('services', 'count', 'categories', 'regions'));
    }

    public function show($id)
    {
        $categories = Category::all();

        $service = Service::findOrFail($id);

        $comments = $service->comments;

        if ($service->published) {
            return view('front.services.show', compact('service', 'comments', 'categories'));
        } else {
            return view('front.services.hidden', 'categories');
        }
    }
}
