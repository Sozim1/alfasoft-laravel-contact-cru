<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_contact_can_be_created_with_valid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(302); // Redirecionamento após criação
        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function contact_name_must_be_at_least_six_characters()
    {
        $response = $this->post('/contacts', [
            'name' => 'John',
            'contact' => '123456789',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function contact_email_must_be_unique()
    {
        Contact::create([
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'john@example.com',
        ]);

        $response = $this->post('/contacts', [
            'name' => 'Jane Doe',
            'contact' => '987654321',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function contact_phone_must_be_nine_digits()
    {
        $response = $this->post('/contacts', [
            'name' => 'John Doe',
            'contact' => '12345678', // 8 digits, should fail
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('contact');
    }
}
