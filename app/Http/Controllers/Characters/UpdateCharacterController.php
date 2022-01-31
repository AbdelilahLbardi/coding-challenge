<?php

namespace App\Http\Controllers\Characters;

use App\Actions\Character\UpdateCharacter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateCharacterController extends Controller
{
    /**
     * Handle the incoming request.
     * @param UpdateCharacter $action
     */
    public function __invoke($id, UpdateCharacter $action)
    {
        $data = request()->validate([
            'name' => 'required',
            'occupation' => 'required',
            'nickname' => 'required',
            'status' => 'required|in:alive,dead'
        ]);

        $character = $action->execute($id, $data);

        return response($character->toArray(), Response::HTTP_OK);
    }
}
