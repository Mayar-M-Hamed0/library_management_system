<?php

namespace Tests\Feature;

use App\Models\Patron;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class patronTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testPatronResourceRoutes(): void
    {
        // Create a patron
        $patron = Patron::factory()->create();

        // Test index route
        $response = $this->get('/api/patrons');
        $response->assertStatus(200);

        // Test show route
        $response = $this->get('/api/patrons/' . $patron->id);
        $response->assertStatus(200);

        // Test store route
        $response = $this->post('/api/patrons', [
            'name' => 'John Doe',
            'phone' => '1234567890'
        ]);
        $response->assertStatus(201);

        // Test update route
        $response = $this->put('/api/patrons/' . $patron->id, [
            'name' => 'Updated Name',
            'phone' => '0987654321'
        ]);
        $response->assertStatus(200);

        // Test delete route
        $response = $this->delete('/api/patrons/' . $patron->id);
        $response->assertStatus(204);
    }
}
