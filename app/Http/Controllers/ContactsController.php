<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Inertia\Inertia;

class ContactsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $contacts = Contact::get();

        return Inertia::render('Contacts', [
            'contacts' => $contacts->transform(function (Contact $contact) {
                return [
                    'id' => $contact->getAttribute('id'),
                    'team_id' => $contact->getAttribute('id'),
                    'name' => $contact->getAttribute('name'),
                    'phone' => $contact->getAttribute('phone'),
                    'email' => $contact->getAttribute('email'),
                    'sticky_phone_number_id' => $contact->getAttribute('sticky_phone_number_id'),
                    'created_at' => $contact->getAttribute('created_at'),
                    'updated_at' => $contact->getAttribute('updated_at'),
                    'custom_attributes' => $contact->customAttributes()->get()
                ];
            })
        ]);
    }

}
