<?php

namespace Tests\Unit;

use App\Services\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Mockery;
use PHPUnit\Framework\TestCase;

class ContactServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if can get table fields.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testTableFields()
    {
        $contactService = Mockery::mock(new ContactService);
        app()->instance(ContactService::class, $contactService);

        $contactService->shouldReceive('getContactFields')->once()->andReturn([]);

        $testSubject = app()->make(ContactService::class);
        $result = $testSubject->getContactFields();

        $this->assertIsArray($result);
    }

    /**
     * Test file parse.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testParseContacts()
    {
        $contactService = Mockery::mock(new ContactService);
        app()->instance(ContactService::class, $contactService);
        $contactService->shouldReceive('parseContacts')->with(UploadedFile::class)->once()->andReturn([]);

        $file_content = '"FooKey", "BarKey", "BarKey2", "BarKey3", "BarKey4", "BarKey5", "BarKey6", "BarKey7", "BarKey8"
                         "example@examole.com", "example","2","2","+38000000000","CustomAttr","CustomAttr34","CustomAttr123"
                         "example.example@example.com", "example","1","1","+38000000001","CustomAttr2","CustomAttr12","CustomAttr213"';
        $file = UploadedFile::fake()->createWithContent('testcase.csv', $file_content);

        $testSubject = app()->make(ContactService::class);
        $result = $testSubject->parseContacts($file);

        $this->assertIsArray($result);
    }

    /**
     * Test file import.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testImportContacts()
    {
        $contactService = Mockery::mock(new ContactService);
        app()->instance(ContactService::class, $contactService);
        $contactService->shouldReceive('importContacts')->with(UploadedFile::class)->once()->andReturn([]);


        $file_content = '"FooKey", "BarKey", "BarKey2", "BarKey3", "BarKey4", "BarKey5", "BarKey6", "BarKey7", "BarKey8"
                         "example@examole.com", "example","2","2","+38000000000","CustomAttr","CustomAttr34","CustomAttr123"
                         "example.example@example.com", "example","1","1","+38000000001","CustomAttr2","CustomAttr12","CustomAttr213"';
        $file = UploadedFile::fake()->createWithContent('testcase.csv', $file_content);

        $testSubject = app()->make(ContactService::class);
        $result = $testSubject->importContacts($file);

        $this->assertIsArray($result);
    }
}
