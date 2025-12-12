<?php


namespace App\Services\ContactSources;


use App\Models\Lead;


class LeadContactSource implements ContactSourceInterface
{
    public function __construct(protected Lead $lead)
    {
    }


    public function toContactAttributes(): array
    {
        return [
            'first_name' => $this->lead->first_name,
            'last_name' => $this->lead->last_name,
            'email' => $this->lead->email,
            'phone' => $this->lead->phone,
            'type' => 'b2c',
            'source_type' => 'lead',
            'source_id' => $this->lead->id,
        ];
    }


    public function getSourceType(): string
    {
        return 'lead';
    }


    public function getSourceId(): int
    {
        return (int) $this->lead->id;
    }
}