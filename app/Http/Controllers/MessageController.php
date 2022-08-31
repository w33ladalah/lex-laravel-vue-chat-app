<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getBySession()
    {
        $messages = Message::where('session_id', session()->getId())->get();
        return response()->json([
            'status' => 'SUCCESS',
            'data' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $message = $request->input('body');
        $session = session()->getId();
        $dataToSave = [
            'session_id' => $session,
            'body' => $message
        ];

        $newMessage = Message::create($dataToSave);

        return response()->json([
            'status' => 'SUCCESS',
            'data' => $newMessage,
        ]);
    }
}
