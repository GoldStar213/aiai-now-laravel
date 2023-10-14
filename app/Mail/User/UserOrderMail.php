<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;

class UserOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $data;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $id)
    {
        //
        $this->type  = $type;
        $this->order = Order::findOrFail($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == config('constants.order_mail_type.new')) {
            $this->data = [
                'title' => '申請ありがとうございます！'
            ];

            return $this->subject($this->data['title'])
                        ->markdown('emails.user.order.new');
        } else if ($this->type == config('constants.order_mail_type.confirmed')) {
            $this->data = [
                'title' => '申請の確認がありました！'
            ];

            return $this->subject($this->data['title'])
                        ->markdown('emails.user.order.confirmed');
        } else if ($this->type == config('constants.order_mail_type.refused')) {
            $this->data = [
                'title' => '注文は拒否されました！'
            ];

            return $this->subject($this->data['title'])
                        ->markdown('emails.user.order.refused');
        }
    }
}
