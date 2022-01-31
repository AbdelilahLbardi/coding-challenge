<?php


namespace App\Actions\Character;


use App\Models\Character;

class UpdateCharacter
{
    public function execute(int $id, array $data): Character
    {
        return tap(Character::query()->findOrFail($id))
            ->update([
                'name' => $data['name'],
                'occupation' => $data['occupation'],
                'nickname' => $data['nickname'],
                'status' => $data['status']
            ]);
    }
}
