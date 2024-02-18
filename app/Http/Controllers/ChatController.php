<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\PrivateMessageSent;

class ChatController extends Controller
{

    // this function should be moved to th homeCOntroller incase you want to make it as model
    public function index()
    {
        $contacts = User::where('id', '<>', auth()->user()->id)->get();

        return view('chat', compact('contacts'));
        // return view('messages.index');
    }


    // creating new message
    public function sendMessage(Request $request)
    {
        $message = $this->storeMessage($request);
        // event(new MessageSent(request('message'), request('sender')));
        broadcast(new PrivateMessageSent($message))->toOthers();

        return response()->json(['message'=> $message]);

    }
    public function storeMessage(Request $request)
    {
        // we need some validation here
        // dd(request()->all());
        return Message::create([
            'message' => request('message'),
            'sender' => request('sender'),
            'reciever' => request('reciever'),
        ]);
    }

    public function getMessages()
    {
        $messages = Message::query()
            ->oldest()
            ->where(function ($query) {
                $query->where('sender', '=', auth()->id())
                    ->where('reciever', '=', request('reciever'));
            })
            ->orWhere(function ($query) {
                $query->where('reciever', '=', auth()->id())
                    ->where('sender', '=', request('reciever'));
            })
            ->get();

        return response()->json($messages);
    }
}
