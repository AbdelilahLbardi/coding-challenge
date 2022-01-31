<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCharacterTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation()
    {
        $this->postJson(route('characters.update', 1), $this->invalidData())
            ->assertJsonValidationErrors([
                "name" => [
                    "The name field is required."
                ],
                "occupation" => [
                    "The occupation field is required."
                ],
                "nickname" => [
                    "The nickname field is required."
                ],
                "status" => [
                    "The status field is required."
                ]
            ])
            ->assertStatus(422);
    }

    public function test_status_cannot_be_something_else_than_alive_or_dead()
    {
        $data = $this->invalidData([
            'name' => 'name 1',
            'nickname' => 'nickname test',
            'occupation' => ['test1', 'test2'],
            'status' => 'invalid status'
        ]);

        $this->postJson(route('characters.update', 1), $data)
            ->assertJsonValidationErrors([
                "status" => [
                    "The selected status is invalid."
                ]
            ])
            ->assertStatus(422);
    }

    private function invalidData($data = [])
    {
        return array_merge([
            'name' => '',
            'nickname' => '',
            'occupation' => '',
            'status' => ''
        ], $data);
    }
}
