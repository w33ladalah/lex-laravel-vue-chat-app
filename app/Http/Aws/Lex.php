<?php
namespace App\Http\Aws;

use Illuminate\Support\Facades\App;

class Lex
{
    private $runtime;

    private $sessionId;

    private $botId;

    private $botAliasId;

    private $localeId;

    public function __construct($botId, $botAliasId, $localeId, $sessionId)
    {
        $this->runtime = App::make('aws')->createClient('runtime.lex.v2');
        $this->sessionId = $sessionId;
        $this->botId = $botId;
        $this->botAliasId = $botAliasId;
        $this->localeId = $localeId;
    }

    public function startConversation()
    {
        try {
            $conversation = $this->runtime->putSession([
                'botId' => $this->botId,
                'botAliasId' => $this->botAliasId,
                'localeId' => $this->localeId,
                'sessionId' => $this->sessionId,
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

    public function getConversationSession()
    {

    }
}
