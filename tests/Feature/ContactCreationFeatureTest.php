<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Lead;
use App\Models\Account;
use App\Models\Contact;
use App\Services\ContactCreationService;
use App\Services\ContactSources\LeadContactSource;
use App\Services\ContactSources\AccountContactSource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCreationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_contact_when_lead_is_created()
    {
        // Arrange: create lead
        $lead = Lead::factory()->create([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'johnlead@test.com',
            'phone'      => '9999999999',
        ]);

        // Act: manually trigger service (or observer if you added that)
        $service = new ContactCreationService();
        $service->createFromSource(new LeadContactSource($lead));

        // Assert: Contact created
        $this->assertDatabaseHas('contacts', [
            'email'      => 'johnlead@test.com',
            'source_type'=> 'lead',
            'source_id'  => $lead->id
        ]);
    }

    /** @test */
    public function it_creates_contact_when_account_is_created()
    {
        // Arrange: create account
        $account = Account::factory()->create([
            'company_name'        => 'Apple Inc.',
            'contact_first_name'  => 'Steve',
            'contact_last_name'   => 'Jobs',
            'contact_email'       => 'steve@apple.com',
            'contact_phone'       => '8888888888',
        ]);

        // Act
        $service = new ContactCreationService();
        $service->createFromSource(new AccountContactSource($account));

        // Assert
        $this->assertDatabaseHas('contacts', [
            'email'      => 'steve@apple.com',
            'source_type'=> 'account',
            'source_id'  => $account->id
        ]);
    }

    /** @test */
    public function it_updates_contact_if_contact_already_exists()
    {
        // Existing contact
        $existing = Contact::factory()->create([
            'email' => 'existing@test.com',
            'first_name' => 'Old',
            'last_name' => 'Name'
        ]);

        // New lead with same email (should update)
        $lead = Lead::factory()->create([
            'first_name' => 'New',
            'last_name'  => 'Updated',
            'email'      => 'existing@test.com',
        ]);

        $service = new ContactCreationService();
        $contact = $service->createFromSource(new LeadContactSource($lead));

        // Assert update
        $this->assertEquals('New', $contact->first_name);
        $this->assertEquals('Updated', $contact->last_name);
    }
}
