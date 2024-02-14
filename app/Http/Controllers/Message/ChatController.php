<?php

namespace App\Http\Controllers\Message;

use App\Events\ChatNotification;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Chat::all();
        return $messages;
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $message = Chat::create([
            'message'=>$request->message,
            'sender_id'=>1,
            'receiver_id' => 2
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => true, 'data' => $message]);
    }
}
