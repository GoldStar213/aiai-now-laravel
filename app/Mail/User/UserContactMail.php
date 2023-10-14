<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Contact;

class UserContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $data;
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $id)
    {
        //
        $this->type  = $type;
        $this->contact = Contact::findOrFail($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->type == config('constants.contact_mail_type.new')) {
            $this->data = [
                'title' => 'お問い合わせありがとうございます！'
            ];

            return $this->subject($this->data['title'])
                        ->markdown('emails.user.contact.new');
        }
    }
}
