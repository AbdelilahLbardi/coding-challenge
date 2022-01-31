<?php


namespace App\Services;


use App\Models\Character;
use App\Models\Quote;

class QuoteService extends BreakingBadService
{
    const RESOURCE = 'quotes';

    public function fetch()
    {
        $this->service
            ->get(self::RESOURCE)
            ->collect()
            ->each(fn ($item) => Quote::query()->create(
                $this->mapResponse($item)
            ));
    }

    public function mapResponse(array $item): array
    {
        $character = Character::findByNameOrCreate($item['author']);

        return [
            'id' => $item['quote_id'],
            'quote' => $item['quote'],
            'character_id' => $character->id
        ];
    }
}
