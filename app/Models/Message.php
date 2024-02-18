<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'sender', 'reciever'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever');
    }
}
