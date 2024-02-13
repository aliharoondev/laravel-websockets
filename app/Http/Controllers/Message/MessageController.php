<?php

namespace App\Http\Controllers\Message;

use App\Events\ChatNotification;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return $messages;
    }
    public function sendMessage(Request $request)
    {
        $message = Message::create($request->validate([
            'message' => 'required',
        ]));

        // $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
        //     'cluster' => env('PUSHER_APP_CLUSTER'),
        //     'useTLS' => false,
        // ]);

        // $pusher->trigger('chat-notification', 'chatNotification', $message);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => true, 'data' => $message]);


        // return to_route('dashboard');
    }
}