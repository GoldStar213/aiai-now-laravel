<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;

class AdminOrderMail extends Mailable
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
                'title' => '新規の申請が届けました！'
            ];

            return $this->subject($this->data['title'])
                        ->markdown('emails.admin.order.new');
        }
    }
}
