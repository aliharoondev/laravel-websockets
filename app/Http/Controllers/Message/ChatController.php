<?php

namespace App\Http\Controllers\Message;

use App\Events\ChatNotification;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $receiverId = $request->receiver_id ?? 2;
        $message = Chat::create([
            'message'=>$request->message,
            'sender_id'=>Auth::id(),
            'receiver_id' => $receiverId
        ]);

        broadcast(new MessageSent($message['message'], auth()->user()->id, $receiverId))->toOthers();

        return response()->json(['status' => true, 'data' => $message]);
    }
}
