<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller{
    public function index()
    {
        return response()->json(Movie::all(), 200);
    }

}