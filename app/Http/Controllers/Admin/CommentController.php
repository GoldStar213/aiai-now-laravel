<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Service;

class CommentController extends Controller
{
    private function updateServiceRating($service_id) {
        $service = Service::findOrFail($service_id);

        if (!empty($service) && !empty($service->comments) && $service->comments->count() > 0) {
            $sum = 0;
            foreach ($service->comments as $comment) {
                $sum += $comment->rating;
            }
            $service->rating = $sum * 1000 / (5 * $service->comments->count());
            $service->save();
        }
    }

    public function create(Request $req)
    {
        Comment::create([
            'service_id'    => $req->service, 
            'title'         => $req->title, 
            'content'       => $req->content, 
            'rating'        => $req->rating, 
        ]);

        $this->updateServiceRating($req->service);

        return redirect(route('admin.services.edit', $req->service));
    }

    public function process(Request $req)
    {
        $comment = Comment::findOrFail($req->target);

        $service_id = $comment->service_id;

        if ($req->type == 'update') {
            $comment->title   = $req->title;
            $comment->content = $req->content;
            $comment->rating  = $req->rating;
            $comment->save();
        } else if ($req->type == 'delete') {
            $comment->delete();
        }

        $this->updateServiceRating($service_id);

        return redirect(route('admin.services.edit', $req->service));
    }
}