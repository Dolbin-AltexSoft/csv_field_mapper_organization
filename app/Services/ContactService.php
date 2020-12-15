<?php

namespace App\Services;


use App\Models\Contact;
use Illuminate\Http\UploadedFile;

class ContactService
{

    /**
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
            foreach ($file_data[0] as $key => $value) {
                $headers[] = $value;
            }
            $contacts_data = array_slice($file_data, 1);
        }

        return [
            'headers' => $headers,
            'contacts' => $contacts_data
        ];
    }

    /**
     * @param  array  $data
     * @throws \Throwable
     */
    public function importContacts($data = [])
    {
        foreach ($data as $contact) {
            /**
             * @var $contact Contact
             */
            $contact = (new Contact)->saveOrFail($contact['fields']);
            $contact->customAttributes()->create($contact['custom_attributes']);

        }
    }
}
