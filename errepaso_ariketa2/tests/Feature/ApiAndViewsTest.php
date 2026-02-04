<?php

use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Crear datos de prueba
    $this->user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->author1 = Author::create([
        'izena' => 'Jon',
        'abizenak' => 'Agirre',
    ]);

    $this->author2 = Author::create([
        'izena' => 'Miren',
        'abizenak' => 'Etxeberria',
    ]);

    $this->book1 = Book::create([
        'izenburua' => 'Laravel Pro',
        'argitalapen_urtea' => 2024,
        'author_id' => $this->author1->id,
    ]);

    $this->book2 = Book::create([
        'izenburua' => 'PHP Masterclass',
        'argitalapen_urtea' => 2023,
        'author_id' => $this->author1->id,
    ]);
});

// ==================== TESTS DE API AUTHORS ====================

test('se puede listar todos los autores con autenticación', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->getJson('/api/authors');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonFragment(['izena' => 'Jon'])
        ->assertJsonFragment(['izena' => 'Miren']);
});

test('listar autores sin autenticación devuelve 401', function () {
    $response = $this->getJson('/api/authors');
    $response->assertStatus(401);
});

test('se puede ver un autor específico con autenticación', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->getJson('/api/authors/' . $this->author1->id);

    $response->assertStatus(200)
        ->assertJson([
            'id' => $this->author1->id,
            'izena' => 'Jon',
            'abizenak' => 'Agirre',
        ]);
});

test('se puede crear un nuevo autor con datos válidos', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->postJson('/api/authors', [
            'izena' => 'Ane',
            'abizenak' => 'Gómez',
        ]);

    $response->assertStatus(201)
        ->assertJsonFragment(['izena' => 'Ane'])
        ->assertJsonFragment(['abizenak' => 'Gómez']);

    $this->assertDatabaseHas('authors', [
        'izena' => 'Ane',
        'abizenak' => 'Gómez',
    ]);
});

test('crear autor sin nombre falla con validación', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->postJson('/api/authors', [
            'abizenak' => 'Test',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['izena']);
});

test('crear autor con nombre muy largo falla con validación', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->postJson('/api/authors', [
            'izena' => str_repeat('a', 76), // Más de 75 caracteres
            'abizenak' => 'Test',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['izena']);
});

test('se puede eliminar un autor existente', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->deleteJson('/api/authors/' . $this->author1->id);

    $response->assertStatus(204);

    $this->assertDatabaseMissing('authors', [
        'id' => $this->author1->id,
    ]);
});

test('eliminar un autor inexistente devuelve 404', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->deleteJson('/api/authors/9999');

    $response->assertStatus(404);
});

// ==================== TESTS DE API BOOKS ====================

test('se puede listar todos los libros con autenticación', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->getJson('/api/books');

    $response->assertStatus(200)
        ->assertJsonCount(2)
        ->assertJsonFragment(['izenburua' => 'Laravel Pro'])
        ->assertJsonFragment(['izenburua' => 'PHP Masterclass']);
});

test('listar libros sin autenticación devuelve 401', function () {
    $response = $this->getJson('/api/books');
    $response->assertStatus(401);
});

test('los libros incluyen la relación con el autor', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    $response = $this->withToken($token)
        ->getJson('/api/books');

    $response->assertStatus(200);
    
    $books = $response->json();
    expect($books[0])->toHaveKey('author_id');
});

// ==================== TESTS DE RELACIONES ====================

test('un autor puede tener múltiples libros', function () {
    expect($this->author1->books)->toHaveCount(2);
    expect($this->author1->books->first()->izenburua)->toBe('Laravel Pro');
});

test('un libro pertenece a un autor', function () {
    expect($this->book1->author->izena)->toBe('Jon');
    expect($this->book1->author_id)->toBe($this->author1->id);
});

// ==================== TESTS DE VIEWS ====================

test('la ruta raíz devuelve información de la API', function () {
    $response = $this->getJson('/');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'version',
            'endpoints',
        ])
        ->assertJson([
            'message' => 'API Laravel - Sistema de Autores y Libros',
            'version' => '1.0',
        ]);
});

test('la página de bienvenida contiene información de la API', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'version',
            'endpoints' => []
        ]);

    $data = $response->json();
    expect($data['endpoints'])->toBeArray();
    expect($data['endpoints'])->toHaveKey('POST /api/login');
    expect($data['endpoints'])->toHaveKey('GET /api/authors');
});

// ==================== TESTS DE MODELOS ====================

test('el modelo Author tiene los campos fillable correctos', function () {
    $author = new Author();
    expect($author->getFillable())->toContain('izena', 'abizenak');
});

test('el modelo Book tiene los campos fillable correctos', function () {
    $book = new Book();
    expect($book->getFillable())->toContain('izenburua', 'argitalapen_urtea', 'author_id');
});

test('se puede crear un autor con nombre y apellido', function () {
    $author = Author::create([
        'izena' => 'Nombre Completo',
        'abizenak' => 'Apellido Completo',
    ]);

    expect($author->izena)->toBe('Nombre Completo');
    expect($author->abizenak)->toBe('Apellido Completo');
});

test('el año de publicación del libro se guarda correctamente', function () {
    expect($this->book1->argitalapen_urtea)->toBe(2024);
    expect($this->book2->argitalapen_urtea)->toBe(2023);
});

// ==================== TESTS DE INTEGRACIÓN ====================

test('flujo completo: crear autor, crear libro y listarlos', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;

    // Crear autor
    $authorResponse = $this->withToken($token)
        ->postJson('/api/authors', [
            'izena' => 'Nuevo Autor',
            'abizenak' => 'Apellido Test',
        ]);

    $authorResponse->assertStatus(201);
    $newAuthorId = $authorResponse->json('id');

    // Crear libro para ese autor
    $newBook = Book::create([
        'izenburua' => 'Libro del Nuevo Autor',
        'argitalapen_urtea' => 2025,
        'author_id' => $newAuthorId,
    ]);

    // Verificar que el libro se creó correctamente
    expect($newBook->author->izena)->toBe('Nuevo Autor');

    // Listar libros y verificar que incluye el nuevo
    $booksResponse = $this->withToken($token)
        ->getJson('/api/books');

    $booksResponse->assertStatus(200)
        ->assertJsonFragment(['izenburua' => 'Libro del Nuevo Autor']);
});

test('eliminar un autor no afecta la base de datos de forma inesperada', function () {
    $token = $this->user->createToken('test-token')->plainTextToken;
    
    $initialCount = Author::count();

    $this->withToken($token)
        ->deleteJson('/api/authors/' . $this->author2->id);

    expect(Author::count())->toBe($initialCount - 1);
    
    // El autor1 todavía existe
    $this->assertDatabaseHas('authors', [
        'id' => $this->author1->id,
    ]);
});

// ==================== TESTS DE BÚSQUEDA/FILTRO ====================

test('se puede filtrar autores por nombre (izena) en la vista', function () {
    // No requiere autenticación porque es una vista web, no API
    $response = $this->get('/authors?search=Jon');

    $response->assertStatus(200)
        ->assertSeeText('Jon')
        ->assertDontSeeText('Miren');
});

test('se puede filtrar autores por apellido (abizenak) en la vista', function () {
    $response = $this->get('/authors?search=Etxeberria');

    $response->assertStatus(200)
        ->assertSeeText('Miren')
        ->assertDontSeeText('Jon');
});

test('la búsqueda es case-insensitive', function () {
    $response = $this->get('/authors?search=jon');

    $response->assertStatus(200)
        ->assertSeeText('Jon');
});

test('búsqueda sin resultados muestra mensaje apropiado', function () {
    $response = $this->get('/authors?search=NoExiste');

    $response->assertStatus(200)
        ->assertSeeText('Ez da aurorik aurkitu');
});

test('sin parámetro de búsqueda muestra todos los autores', function () {
    $response = $this->get('/authors');

    $response->assertStatus(200)
        ->assertSeeText('Jon')
        ->assertSeeText('Miren');
});

test('el formulario de búsqueda es visible en la vista', function () {
    $response = $this->get('/authors');

    $response->assertStatus(200)
        ->assertSeeText('Bilatu')
        ->assertSeeText('Bilatu izena edo abizenak');
});

test('el botón de limpiar búsqueda aparece cuando hay búsqueda activa', function () {
    $response = $this->get('/authors?search=Jon');

    $response->assertStatus(200)
        ->assertSeeText('Garbitu');
});

test('el botón de limpiar búsqueda no aparece sin búsqueda', function () {
    $response = $this->get('/authors');

    $response->assertDontSeeText('Garbitu');
});
