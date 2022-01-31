<?php


namespace App\Services;


use App\Models\Character;
use Illuminate\Support\Facades\Http;

class CharacterService extends BreakingBadService
{
    const RESOURCE = 'characters';

    public function fetch()
    {
        Http::get(config('services.breaking_bad_api.url') . CharacterService::RESOURCE)
            ->collect()
            ->map(fn ($item) => Character::query()->create(
                $this->mapResponse($item)
            ));
    }

    public function mapResponse(array $item): array
    {
        return [
            'id' => $item['char_id'],
            'name' => $item['name'],
            'nickname' => $item['nickname'],
            'occupation' => $item['occupation'],
            'image' => $item['img'],
            'status' => $item['status'],
            'category' => $item['category'],
            'seasons' => $item['appearance']
        ];
    }
}
