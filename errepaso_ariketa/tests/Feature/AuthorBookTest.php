<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Author;
use App\Models\Book;

class AuthorBookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(); // Ejecuta los seeders para tener datos
    }

    #[Test]
    public function home_page_shows_authors()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $authors = Author::all();
        foreach ($authors as $author) {
            $response->assertSee($author->izena);
            $response->assertSee($author->abizenak);
        }
    }

    #[Test]
    public function author_show_page_shows_books()
    {
        $author = Author::first();
        $response = $this->get(route('authors.show', $author));
        $response->assertStatus(200);

        foreach ($author->books as $book) {
            $response->assertSee($book->izenburua);
        }
    }

    #[Test]
    public function api_can_create_author()
    {
        $data = [
            'izena' => 'Test',
            'abizenak' => 'User'
        ];

        $response = $this->postJson('/api/authors', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['izena' => 'Test']);
        $this->assertDatabaseHas('authors', ['izena' => 'Test']);
    }

    #[Test]
    public function api_can_delete_author()
    {
        $author = Author::first();
        $response = $this->deleteJson("/api/authors/{$author->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }

    #[Test]
    public function api_can_list_books()
    {
        $response = $this->getJson('/api/books');
        $response->assertStatus(200);

        $books = Book::all();
        foreach ($books as $book) {
            $response->assertJsonFragment(['izenburua' => $book->izenburua]);
        }
    }
}
