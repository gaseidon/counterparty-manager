<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CounterpartyTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_counterparty()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->postJson('/api/counterparties', [
            'inn' => '7707083893'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'inn', 'name', 'ogrn', 'address'
            ]);
    }
}
