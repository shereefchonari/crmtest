<?php


namespace App\Services;


use App\Models\Contact;
use App\Services\ContactSources\ContactSourceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ContactCreationService
{
    /**
    * Create or update a contact based on provided source.
    * If a contact already exists for the same source_type+source_id, update it.
    * Otherwise try to match by email (if present) to avoid duplicates.
    */
    public function createFromSource(ContactSourceInterface $source): Contact
    {
        $attrs = $source->toContactAttributes();


        // Try to find by source unique key
        $contact = Contact::where('source_type', $source->getSourceType())
            ->where('source_id', $source->getSourceId())
            ->first();


        if ($contact) {
            $contact->update($attrs);
            return $contact->refresh();
        }


        // If email exists, try to find existing contact by email and attach source
        if (!empty($attrs['email'])) {
            $contact = Contact::where('email', $attrs['email'])->first();
            if ($contact) {
                $contact->fill($attrs);
                $contact->save();
                return $contact->refresh();
            }
        }


        // Create a new contact
        return Contact::create($attrs);
    }
}