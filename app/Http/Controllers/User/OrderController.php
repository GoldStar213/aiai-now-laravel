<?php

namespace App\Http\Controllers\User;

use Mail;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\Admin\AdminMessageMail;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = \Auth::user()->id;

        $orders = Order::where([
            [ 'user_id', $user_id ], 
        ])->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('user.orders.show', compact('order'));
    }

    public function message(Request $req)
    {
        Message::create([
            'order_id' => $req->order, 
            'send_id' => $req->user, 
            'recv_id' => 0, 
            'content' => $req->message, 
            'read_flg_01' => false, 
            'read_flg_02' => false, 
        ]);

        Mail::to(env('ADMIN_ADDRESS'))->send(new AdminMessageMail($req->order));
        
        return redirect(route('user.orders.show', $req->order));
    }
}
