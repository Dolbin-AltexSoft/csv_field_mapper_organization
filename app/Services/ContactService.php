<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Traits\EnumeratesValues;
use Throwable;

class ContactService
{
    /**
     * Parse contacts from file.
     *
     * @param  UploadedFile  $file
     * @return array
     */
    public function parseContacts(UploadedFile $file)
    {
        $path = $file->getRealPath();
        $file_data = array_map('str_getcsv', file($path));

        $headers = [];
        $contacts_data = [];
        if (count($file_data) > 0) {
            $values = array_slice($file_data, 1);
            foreach ($file_data[0] as $key => $value) {
                $headers[] = $value;
            }
            foreach ($values as $key => $value) {
                $contacts_data[$key] = [];
                foreach ($value as $header_key => $item) {
                    $contacts_data[$key][$headers[$header_key]] = $item;
                }
            }
        }

        return [
            'contactsHeaders' => $headers,
            'contactsData' => $contacts_data,
        ];
    }

    /**
     * Import contacts.
     *
     * @param  array  $data
     * @throws Throwable
     */
    public function importContacts($data = [])
    {
        foreach ($data as $item) {
            /**
             * @var $contact Contact
             */
            $contact = Contact::create($item['fields']);
            foreach ($item['custom_attributes'] as $attribute) {
                $contact->customAttributes()->create($attribute);
            }
        }
    }

    /**
     * Get list of fields of Contact model.
     *
     * @return array
     */
    public function getContactFields()
    {
        $contact = new Contact();
        $table = $contact->getTable();

        return array_values(array_filter(Schema::getColumnListing($table), function ($column) {
            return $column !== 'id' && $column !== 'created_at' && $column !== 'updated_at';
        }));
    }
}
