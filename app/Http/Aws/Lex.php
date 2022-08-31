<?php
namespace App\Http\Aws;

use Illuminate\Support\Facades\App;

class Lex
{
    private $runtime;

    private $botId;

    private $botAliasId;

    private $localeId;

    public function __construct($botId, $botAliasId, $localeId)
    {
        $this->runtime = App::make('aws')->createClient('runtime.lex.v2');
        $this->botId = $botId;
        $this->botAliasId = $botAliasId;
        $this->localeId = $localeId;
    }

    public function startConversation($sessionId)
    {
        try {
            $conversation = $this->runtime->putSession([
                'botId' => $this->botId,
                'botAliasId' => $this->botAliasId,
                'localeId' => $this->localeId,
                'sessionId' => $sessionId,
                'sessionState' => [],
            ])->toArray();

            return $conversation['@metadata'];
        } catch (\Aws\LexRuntimeV2\Exception\LexRuntimeV2Exception $exception) {
            return [
                'statusCode' => 400,
                'response' => [
                    'message' => $exception->getMessage(),
                ],
            ];
        }
    }

    public function getSession($sessionId)
    {
        try {
            $session = $this->runtime->getSession([
                'botId' => $this->botId,
                'botAliasId' => $this->botAliasId,
                'localeId' => $this->localeId,
                'sessionId' => $sessionId,
            ]);

            return $session;
        } catch (\Aws\LexRuntimeV2\Exception\LexRuntimeV2Exception $exception) {
            return [
                'statusCode' => 404,
                'response' => "Session not found or expired.",
            ];
        }
    }

    public function sendMessage($sessionId, $text)
    {
        try {
            $message = $this->runtime->recognizeText([
                'botId' => $this->botId,
                'botAliasId' => $this->botAliasId,
                'localeId' => $this->localeId,
                'sessionId' => $sessionId,
                'text' => $text,
            ]);

            return $message['messages'];
        } catch (\Aws\LexRuntimeV2\Exception\LexRuntimeV2Exception $exception) {
            return [
                'statusCode' => 400,
                'response' => [
                    'message' => $exception->getMessage(),
                ],
            ];
        }
    }
}
