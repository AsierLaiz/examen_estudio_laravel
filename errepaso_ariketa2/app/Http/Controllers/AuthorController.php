<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        
        if ($search) {
            $authors = Author::where('izena', 'like', '%' . $search . '%')
                ->orWhere('abizenak', 'like', '%' . $search . '%')
                ->get();
        } else {
            $authors = Author::all();
        }
        
        return view('authors.index', [
            'authors' => $authors,
            'search' => $search
        ]);
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }
}