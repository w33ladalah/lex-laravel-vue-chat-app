<?php

namespace App\Console\Commands;

use App\Http\Aws\Lex;
use Illuminate\Console\Command;

class LexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lex:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test lex request';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lex = new Lex('QBDXDUHITR', '9MOAK2OZ7', 'en_US', date('YmdH'));

        dd($lex->startConversation()['response']);

        return 0;
    }
}
