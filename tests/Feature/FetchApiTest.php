<?php

namespace Tests\Feature;

use App\Models\Character;
use App\Models\Death;
use App\Models\Quote;
use App\Services\CharacterService;
use App\Services\DeathService;
use App\Services\QuoteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_calling_command_reaches_the_api()
    {
        $this->mock(CharacterService::class)
            ->shouldReceive('fetch')
            ->once();

        $this->mock(QuoteService::class)
            ->shouldReceive('fetch')
            ->once();

        $this->mock(DeathService::class)
            ->shouldReceive('fetch')
            ->once();

        $this->artisan('breaking-bad-api:fetch')
            ->assertExitCode(0);
    }

}
