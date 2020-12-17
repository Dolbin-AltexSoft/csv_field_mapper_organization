<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ContactParseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test file parse.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::factory()->create();
        $file_content = '"FooKey", "BarKey", "BarKey2", "BarKey3", "BarKey4", "BarKey5", "BarKey6", "BarKey7", "BarKey8"
                         "example@examole.com", "example","2","2","+38000000000","CustomAttr","CustomAttr34","CustomAttr123"
                         "example.example@example.com", "example","1","1","+38000000001","CustomAttr2","CustomAttr12","CustomAttr213"';
        $file = UploadedFile::fake()->createWithContent('testcase.csv', $file_content);


        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/import/parse-contacts', ['file' => $file]);

        $response->assertOk();
    }
}
