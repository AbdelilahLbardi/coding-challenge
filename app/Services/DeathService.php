<?php


namespace App\Services;


use App\Models\Character;
use App\Models\Death;

class DeathService extends BreakingBadService
{
    const RESOURCE = 'deaths';

    public function fetch()
    {
        $this->service
            ->get(self::RESOURCE)
            ->collect()
            ->map(fn ($item) => Death::query()->create(
                $this->mapResponse($item)
            ));
    }

    public function mapResponse(array $item): array
    {
        $character = Character::findByNameOrCreate($item['death']);
        $responsible = Character::findByNameOrCreate($item['responsible']);

        return [
            'id' => $item['death_id'],
            'character_id' => $character->id,
            'cause' => $item['cause'],
            'responsible_id' => $responsible->id,
            'last_words' => $item['last_words'],
            'season' => $item['season'],
            'episode' => $item['episode'],
            'death_caused_count' => $item['number_of_deaths'],
        ];
    }
}
