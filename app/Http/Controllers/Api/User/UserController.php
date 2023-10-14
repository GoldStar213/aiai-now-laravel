<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Like;
use App\Models\Service;

class UserController extends Controller
{
    // public function authorize($ability, $arguments = [])
    // {
    //     // set to true instead of false
    //     return false;
    // }

    private function resConversionJson($result, $statusCode = 200)
    {
        if (empty($statusCode) || $statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }

    public function like(Request $req)
    {
        $item = Like::where([
            [ 'user_id', $req->user ], 
            [ 'service_id', $req->service ], 
        ])->first();

        $service = Service::findOrFail($req->service);

        if (!empty($item) && $item->count() > 0) {
            $item->delete();

            $service->likes = $service->likes - 1;

            $result = [
                'result'   => true,
                'like' => false, 
            ];
        } else {
            Like::Create([
                'user_id' => $req->user, 
                'service_id' => $req->service, 
            ]);

            $service->likes = $service->likes + 1;

            $result = [
                'result'   => true,
                'like' => true, 
            ];
        }

        $service->save();

        return $this->resConversionJson($result);
	}
}
