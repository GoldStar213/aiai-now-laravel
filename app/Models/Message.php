<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'send_id', 
        'recv_id', 
        'content', 
        'read_flg_01', 
        'read_flg_02', 
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
