<?php


namespace App\Services;


use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BreakingBadService
{
    protected PendingRequest $service;

    public function __construct()
    {
        $this->service = Http::baseUrl(config('services.breaking_bad_api.url'));
    }
}
