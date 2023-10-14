<?php

namespace App\Http\Controllers\Admin;

use Mail;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail\User\UserMessageMail;
use App\Mail\User\UserOrderMail;
use App\Models\Message;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
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
        $order = Order::findOrFail($id);

        $messages = $order->messages->sortBy([['created_at', 'desc' ]]);

        return view('admin.orders.edit', compact('order', 'messages'));
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
        $order = Order::findOrFail($id);

        $order->status  = $req->status;
        $order->save();

        return redirect(route('admin.orders.edit', $order->id));
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

    public function message(Request $req)
    {
        $order = Order::findOrFail($req->order);

        if (!empty($req->status)) {
            $order->status = $req->status;
            $order->save();
        }

        if ($req->status == 1) {
            $msg = !empty($req->message) ? $req->message : "注文は確認しました。\nこれから注文の詳細内容についてご相談いたします。";
            Message::create([
                'order_id' => $order->id, 
                'send_id' => 0, 
                'recv_id' => $order->user_id, 
                'content' => $msg, 
                'read_flg_01' => false, 
                'read_flg_02' => false, 
            ]);

            Mail::to($order->user->email)->send(new UserOrderMail(config('constants.order_mail_type.confirmed'), $order->id));
        } else if ($req->status == -1) {
            $msg = !empty($req->message) ? $req->message : "本当に申し訳ございません。\nこれから注文の詳細内容についてご相談いたします。";
            Message::create([
                'order_id' => $order->id, 
                'send_id' => 0, 
                'recv_id' => $order->user_id, 
                'content' => $msg, 
                'read_flg_01' => false, 
                'read_flg_02' => false, 
            ]);

            Mail::to($order->user->email)->send(new UserOrderMail(config('constants.order_mail_type.refused'), $order->id));
        } else {
            Message::create([
                'order_id' => $order->id, 
                'send_id' => 0, 
                'recv_id' => $order->user_id, 
                'content' => $req->message, 
                'read_flg_01' => false, 
                'read_flg_02' => false, 
            ]);
            
            Mail::to($order->user->email)->send(new UserMessageMail($order->id));
        }

        return redirect(route('admin.orders.edit', $req->order));
    }
}