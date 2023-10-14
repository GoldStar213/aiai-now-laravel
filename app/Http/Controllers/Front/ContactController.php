<?php

namespace App\Http\Controllers\Front;

use Mail;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Mail\Admin\AdminContactMail;
use App\Mail\User\UserContactMail;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Region;

class ContactController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();
        $regions = Region::all();

        $type = !empty($req->type) ? $req->type : 0;

        return view('front.contact.index', compact('categories', 'type', 'regions'));
    }

    public function submit(Request $req)
    {
        $contact = Contact::create([
            'email' => $req->email, 
            'type' => $req->type, 
            'content' => $req->content, 
        ]);

        Mail::to(env('ADMIN_ADDRESS'))->send(new AdminContactMail(config('constants.contact_mail_type.new'), $contact->id));
        Mail::to($req->email)->send(new UserContactMail(config('constants.contact_mail_type.new'), $contact->id));

        return redirect(route('front.contact.thanks'));
    }

    public function thanks()
    {
        $categories = Category::all();

        return view('front.contact.thanks', compact('categories'));
    }
}
