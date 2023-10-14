<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class LikeController extends Controller
{
    public function likes()
    {
        $user = \Auth::user();
        $like_services = $user->like_services()->get();

        return view('user.likes.index', compact('like_services'));
    }
}
