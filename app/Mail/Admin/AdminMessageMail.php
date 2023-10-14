<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Order;

class AdminMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        //
        $this->order = Order::findOrFail($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->data = [
            'title' => 'ユーザーからメッセージが届けました！'
        ];

        return $this->subject($this->data['title'])
                    ->markdown('emails.admin.message.new');
    }
}
