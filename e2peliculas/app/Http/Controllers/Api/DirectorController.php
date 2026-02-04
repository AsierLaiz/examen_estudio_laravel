<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'=>'required|string|max:100',
            'pais'=> 'nullable|string|max:100'
        ]);
        
        $director = Director::create($validated);
        return response()->json($director, 201);
    }

   /* public function update(Request $request, Director $director)
    {
        $validated = $request->validate([
            'nombre'=>'required|string|max:100',
            'pais'=> 'nullable|string|max:100'
        ]);

        $director->update($validated);

        return response()->json($director, 200);
    }*/

    public function destroy($id){
        $director = Director::findOrFail($id);
        $director->delete();
        return response()->json(null,204);
    }

}