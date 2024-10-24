<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Club;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClubControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        Club::factory()->count(3)->create();

        $response = $this->get('/api/clubs');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function testStore()
    {
        $response = $this->post('/api/clubs', [
            'nameClub' => 'Club Test'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Success',
            'data' => [
                'nameClub' => 'Club Test'
            ]
        ]);

        $this->assertDatabaseHas('clubs', [
            'nameClub' => 'Club Test'
        ]);
    }


    
    public function testShow()
    {
        $club = Club::factory()->create();

        $response = $this->get("/api/clubs/{$club->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $club->id
        ]);
    }

    public function testUpdate()
    {
        $club = Club::factory()->create([
            'nameClub' => 'Old Name'
        ]);

        $response = $this->put("/api/clubs/{$club->id}", [
            'nameClub' => 'New Name'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Mise à jour avec succès'
        ]);

        $this->assertDatabaseHas('clubs', [
            'id' => $club->id,
            'nameClub' => 'New Name'
        ]);
    }

    public function test_Destroy_club_successfully()
    {
        $club = Club::factory()->create();

        $response = $this->delete("/api/clubs/{$club->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'Supprimé avec succès'
        ]);

        $this->assertDatabaseMissing('clubs', [
            'id' => $club->id
        ]);
    }
}
