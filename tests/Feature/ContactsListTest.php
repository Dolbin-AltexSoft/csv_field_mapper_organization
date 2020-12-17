<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsListTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if can get contact list
     *
     * @return void
     */
    public function testContactList()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/contacts');

        $response->assertOk();
    }
}
