<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Lead;
use App\Models\Contact;
use App\Services\ContactCreationService;
use App\Services\ContactSources\LeadContactSource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactCreationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_contact_from_lead()
    {
        // Arrange: a lead exists
        $lead = Lead::factory()->create([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john@example.com',
            'phone'      => '9999999999',
        ]);

        $service = new ContactCreationService();

        // Act: create contact from lead
        $contact = $service->createFromSource(new LeadContactSource($lead));

        // Assert
        $this->assertDatabaseHas('contacts', [
            'email'      => 'john@example.com',
            'source_type'=> 'lead',
            'source_id'  => $lead->id,
        ]);

        $this->assertEquals('John', $contact->first_name);
    }

    public function test_it_updates_existing_contact_when_source_matches()
    {
        // Existing contact
        $existing = Contact::factory()->create([
            'email' => 'john@example.com',
            'first_name' => 'Old Name'
        ]);

        // Lead with same email
        $lead = Lead::factory()->create([
            'first_name' => 'New Name',
            'email'      => 'john@example.com'
        ]);

        $service = new ContactCreationService();

        // Update contact
        $contact = $service->createFromSource(new LeadContactSource($lead));

        $this->assertEquals('New Name', $contact->first_name);
    }
}
