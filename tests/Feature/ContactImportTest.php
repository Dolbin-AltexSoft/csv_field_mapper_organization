<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactImportTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test contacts import.
     *
     * @return void
     */
    public function testContactsImport()
    {
        $user = User::factory()->create();
        $contacts = [
            [
                'fields' => [
                    'team_id' => 1,
                    'name' => 'A',
                    'email' => 'a@example.com',
                    'phone' => "00000000000",
                    'sticky_phone_number_id' => 1
                ],
                'custom_attributes' => [
                    [
                        'key' => 'fooA',
                        'value' => 'barA'
                    ]
                ]
            ],
            [
                'fields' => [
                    'team_id' => 2,
                    'name' => 'B',
                    'email' => 'b@example.com',
                    'phone' => "00000000001",
                    'sticky_phone_number_id' => 2
                ],
                'custom_attributes' => [
                    [
                        'key' => 'fooB',
                        'value' => 'barB'
                    ]
                ]
            ]
        ];

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/import/import-contacts', $contacts);

        $response->assertOk();
    }
}
