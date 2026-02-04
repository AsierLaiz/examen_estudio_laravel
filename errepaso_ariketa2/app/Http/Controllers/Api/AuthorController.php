<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    public function show(Author $author)
    {
        return response()->json($author);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:75',
            'abizenak' => 'nullable|string|max:255'
        ]);

        $author = Author::create($validated);
        return response()->json($author, 201);
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json(null, 204);
    }
}
