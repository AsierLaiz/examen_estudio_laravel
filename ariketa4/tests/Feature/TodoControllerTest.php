<?php


use Tests\TestCase;
use App\Models\Todo;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        Todo::factory()->count(3)->create();
        $this->getJson('/api/todos')->assertOk();
    }

    public function test_store()
    {
        $user = \App\Models\User::factory()->create(); // crea un usuario en la BD de pruebas

        $response = $this->postJson('/api/todos', [
            'title' => 'Test',
            'state' => 'pending',
            'priority' => 1,
            'user_id' => $user->id, // usar el id del usuario creado
        ]);

        $response->assertStatus(201);
    }


    public function test_show()
    {
        $todo = Todo::factory()->create();
        $this->getJson("/api/todos/{$todo->id}")
            ->assertOk();
    }

    public function test_update()
    {
        $todo = Todo::factory()->create();
        $this->putJson("/api/todos/{$todo->id}", [
            'state' => 'done'
        ])->assertOk();
    }

    public function test_delete()
    {
        $todo = Todo::factory()->create();
        $this->deleteJson("/api/todos/{$todo->id}")
            ->assertNoContent();
    }
}

