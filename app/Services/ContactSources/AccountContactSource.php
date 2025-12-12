<?php


namespace App\Services\ContactSources;


use App\Models\Account;


class AccountContactSource implements ContactSourceInterface
{
    public function __construct(protected Account $account)
    {
    }


    public function toContactAttributes(): array
    {
        return [
            'first_name' => $this->account->contact_first_name,
            'last_name' => $this->account->contact_last_name,
            'email' => $this->account->contact_email,
            'phone' => $this->account->contact_phone,
            'type' => 'b2b',
            'source_type' => 'account',
            'source_id' => $this->account->id,
        ];
    }


    public function getSourceType(): string
    {
        return 'account';
    }


    public function getSourceId(): int
    {
        return (int) $this->account->id;
    }
}