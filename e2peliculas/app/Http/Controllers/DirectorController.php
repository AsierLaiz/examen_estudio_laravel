<?php

namespace App\Http\Controllers;
use App\Models\Director;


use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {
        return view('Director.index',['directors' => Director::all()]);
    }

    public function show(Director $director)
    {
        return view('Director.show', compact('director'));
    }
}
