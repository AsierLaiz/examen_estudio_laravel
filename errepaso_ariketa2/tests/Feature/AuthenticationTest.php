<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Crear un usuario de prueba antes de cada test
    $this->user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);
});

test('un usuario puede hacer login con credenciales válidas', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'user' => [
                'id',
                'name',
                'email',
            ]
        ])
        ->assertJson([
            'token_type' => 'Bearer',
        ]);

    expect($response['access_token'])->not->toBeEmpty();
});

test('el login falla con credenciales inválidas', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('el login requiere email y password', function () {
    $response = $this->postJson('/api/login', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});

test('el login requiere un email válido', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'not-an-email',
        'password' => 'password123',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('un usuario autenticado puede hacer logout', function () {
    // Primero hacemos login
    $loginResponse = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $token = $loginResponse['access_token'];

    // Luego hacemos logout usando el token
    $response = $this->withToken($token)
        ->postJson('/api/logout');

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Sesión cerrada correctamente'
        ]);

    // Verificar que el token fue eliminado de la base de datos
    $this->assertDatabaseMissing('personal_access_tokens', [
        'token' => hash('sha256', explode('|', $token)[1] ?? $token),
    ]);
});

test('no se puede hacer logout sin autenticación', function () {
    $response = $this->postJson('/api/logout');

    $response->assertStatus(401);
});

test('las rutas protegidas requieren autenticación', function () {
    $routes = [
        ['method' => 'get', 'uri' => '/api/authors'],
        ['method' => 'post', 'uri' => '/api/authors'],
        ['method' => 'get', 'uri' => '/api/books'],
        ['method' => 'post', 'uri' => '/api/logout'],
    ];

    foreach ($routes as $route) {
        $response = $this->{$route['method'] . 'Json'}($route['uri']);
        $response->assertStatus(401);
    }
});

test('un usuario autenticado puede acceder a rutas protegidas', function () {
    // Hacer login
    $loginResponse = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $token = $loginResponse['access_token'];

    // Intentar acceder a una ruta protegida
    $response = $this->withToken($token)
        ->getJson('/api/authors');

    // Debe funcionar (200 o similar, no 401)
    $response->assertStatus(200);
});

test('el token de autenticación es de tipo Bearer', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertJson(['token_type' => 'Bearer']);
});

test('cada login genera un token único', function () {
    $response1 = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response2 = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $token1 = $response1['access_token'];
    $token2 = $response2['access_token'];

    expect($token1)->not->toBe($token2);
});
