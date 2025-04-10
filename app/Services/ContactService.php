<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactService
{
    public function store(Request $request): Contact
    {
        return Contact::create($request->only('name', 'contact', 'email'));
    }

    public function update(Request $request, Contact $contact): Contact
    {
        $contact->update($request->only('name', 'contact', 'email'));
        return $contact;
    }

    public function delete(Contact $contact): void
    {
        $contact->delete();
    }
}
