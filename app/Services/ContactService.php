<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


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

    public function exportCsv()
    {
        $contacts = Contact::all();

        $csvData = "ID,Name,Contact,Email\n";

        foreach ($contacts as $contact) {
            $csvData .= "{$contact->id},\"{$contact->name}\",\"{$contact->contact}\",\"{$contact->email}\"\n";
        }

        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }
}
