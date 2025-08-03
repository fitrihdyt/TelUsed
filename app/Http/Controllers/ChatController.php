<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $conversations = Conversation::where('user_one_id', $user->id)
            ->orWhere('user_two_id', $user->id)
            ->with(['userOne', 'userTwo', 'messages'])
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $conversation = Conversation::where(function ($q) use ($user, $id) {
            $q->where('user_one_id', $user->id)->where('user_two_id', $id);
        })->orWhere(function ($q) use ($user, $id) {
            $q->where('user_one_id', $id)->where('user_two_id', $user->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $user->id,
                'user_two_id' => $id,
            ]);
        }

        $messages = Message::where('conversation_id', $conversation->id)
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        $receiver = User::findOrFail($id);

        return view('chat.show', compact('conversation', 'messages', 'receiver'));
    }

    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
