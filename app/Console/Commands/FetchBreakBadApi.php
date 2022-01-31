<?php

namespace App\Console\Commands;

use App\Services\CharacterService;
use App\Services\DeathService;
use App\Services\QuoteService;
use Illuminate\Console\Command;

class FetchBreakBadApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breaking-bad-api:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch API and stores in DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        resolve(CharacterService::class)->fetch();
        resolve(QuoteService::class)->fetch();
        resolve(DeathService::class)->fetch();

        return 0;
    }
}
