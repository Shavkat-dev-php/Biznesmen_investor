<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::create([
            'user_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
            'message' => $request->message,
        ]);

        return response()->json($chat, 201);
    }

    public function fetchChats($recipient_id): JsonResponse
    {
        $chats = Chat::where(function ($q) use ($recipient_id) {
            $q->where('user_id', auth()->id())
                ->where('recipient_id', $recipient_id);
        })->orWhere(function ($q) use ($recipient_id) {
            $q->where('user_id', $recipient_id)
                ->where('recipient_id', auth()->id());
        })->get();

        return response()->json($chats, 200);
    }
}
