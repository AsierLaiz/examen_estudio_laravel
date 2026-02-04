<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class AuthorBookSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            ['izena' => 'J.K.', 'abizenak' => 'Rowling'],
            ['izena' => 'George', 'abizenak' => 'Orwell'],
            ['izena' => 'Gabriel', 'abizenak' => 'García Márquez']
        ];

        foreach ($authors as $authorData) {
            $author = Author::create($authorData);
            Book::create([
                'izenburua' => 'Book 1 of ' . $author->izena,
                'argitalpen_urtea' => 2000,
                'author_id' => $author->id
            ]);
            Book::create([
                'izenburua' => 'Book 2 of ' . $author->izena,
                'argitalpen_urtea' => 2005,
                'author_id' => $author->id
            ]);
        }
    }
}
