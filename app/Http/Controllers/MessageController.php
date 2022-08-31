<?php

namespace App\Http\Controllers;

use App\Http\Aws\Lex;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $lex;

    public function __construct()
    {
        $this->lex = new Lex(
            config('aws.lex.bot_id'),
            config('aws.lex.bot_alias_id'),
            config('aws.lex.bot_locale')
        );
    }

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

        // Save message sent by user.
        Message::create([
            'session_id' => $session,
            'body' => $message
        ]);

        $existingSession = $this->lex->getSession($session);
        if ($existingSession['statusCode'] == 404) {
            $this->lex->startConversation($session);
        }

        $lexBot = $this->lex->sendMessage($session, $message);

        // Save response message from Lex bot.
        Message::create([
            'session_id' => $session,
            'body' => $lexBot[0]['content'],
            'type' => 'lex',
        ]);

        return response()->json([
            'status' => 200,
            'response' => [
                'session_id' => $session,
                'body' => $lexBot[0]['content'],
                'type' => 'lex',
            ],
        ]);
    }
}
