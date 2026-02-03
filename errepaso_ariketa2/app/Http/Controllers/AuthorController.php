<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('authors.index', ['authors' => Author::all()]);
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }
}