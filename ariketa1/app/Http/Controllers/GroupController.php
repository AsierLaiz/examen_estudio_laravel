<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        // Trae todos los grupos con el conteo de estudiantes
        $groups = Group::withCount('students')->get();
        return view('groups.index', compact('groups'));
    }

    public function show(Group $group)
    {
        // Trae el grupo con sus estudiantes
        $group->load('students');
        return view('groups.show', compact('group'));
    }
}