<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the available users to chat with.
     */
    public function index()
    {
        // Get all active users except the current authenticated user
        $users = User::where('id', '!=', Auth::id())
                     ->where('active', 1)
                     ->get();

        return view('chat.index', compact('users'));
    }

    /**
     * Fetch chat history with a specific user.
     */
    public function show($userId)
    {
        $authId = Auth::id();

        $messages = Message::with('sender')
            ->where(function ($query) use ($authId, $userId) {
                $query->where('sender_id', $authId)
                      ->where('receiver_id', $userId);
            })
            ->orWhere(function ($query) use ($authId, $userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Store a new message and broadcast it.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
        ]);

        // Broadcast the event
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender')
        ]);
    }
}
