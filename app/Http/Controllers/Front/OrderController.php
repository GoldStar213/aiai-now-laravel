<?php

namespace App\Http\Controllers\Front;

use Mail;

use Illuminate\Http\Request;
use Symfony\Component\Mailer\Exception\TransportException;

use App\Http\Controllers\Controller;

use App\Mail\Admin\AdminOrderMail;
use App\Mail\User\UserOrderMail;
use App\Models\Category;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function order(Request $req)
    {
        $order = Order::create([
            'service_id' => $req->service, 
            'user_id'    => $req->user, 
            'type'       => $req->type, 
            'status'     => 0
        ]);

        Mail::to(env('ADMIN_ADDRESS'))->send(new AdminOrderMail(config('constants.order_mail_type.new'), $order->id));
        Mail::to($order->user->email)->send(new UserOrderMail(config('constants.order_mail_type.new'), $order->id));

        Message::create([
            'order_id' => $order->id, 
            'send_id' => 0, 
            'recv_id' => $req->user, 
            'content' => "申請ありがとうございます！\n運営者からの確認までお待ちください！", 
            'read_flg_01' => false, 
            'read_flg_02' => false, 
        ]);

        return redirect(route('front.order.complete', $order->id));
    }

    public function complete($order)
    {
        $categories = Category::all();

        return view('front.order.complete', compact('categories', 'order'));
    }
}
