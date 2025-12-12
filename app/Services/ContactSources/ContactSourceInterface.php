<?php


namespace App\Services\ContactSources;


use App\Models\Contact;


interface ContactSourceInterface
{
    /**
    * Return an array of attributes to create or update a Contact.
    *
    * ['first_name' => ..., 'email' => ..., 'type' => 'b2c', 'source_type' => 'lead', 'source_id' => 1]
    */
    public function toContactAttributes(): array;


    /**
    * Unique source key used to detect duplicates (e.g. ['source_type' => 'lead', 'source_id' => 1])
    */
    public function getSourceType(): string;


    public function getSourceId(): int;
}