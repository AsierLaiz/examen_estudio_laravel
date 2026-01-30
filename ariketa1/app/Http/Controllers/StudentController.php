<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Group;

class StudentController extends Controller
{
    private $ikasleak = [
        ['id' => 1, 'izena' => 'Ane', 'adina' => 20],
        ['id' => 2, 'izena' => 'Unai', 'adina' => 22],
        ['id' => 3, 'izena' => 'Maite', 'adina' => 19],
        ['id' => 4, 'izena' => 'Gorka', 'adina' => 21],
        ['id' => 5, 'izena' => 'Leire', 'adina' => 23],
        ['id' => 6, 'izena' => 'Iker', 'adina' => 20],
        ['id' => 7, 'izena' => 'Amaia', 'adina' => 21],
        ['id' => 8, 'izena' => 'Eneko', 'adina' => 22],
        ['id' => 9, 'izena' => 'Ainhoa', 'adina' => 19],
        ['id' => 10, 'izena' => 'Jon', 'adina' => 23],
    ];
    public function index(Request $request)
    {
        $query = Student::query()->with('group');
        
        if ($request->has('adinMax')) {
            $query->where('age','<=',$request->adinMax);
        }
        $ikasleak = $query->get();
        return view('students.index', ['ikasleak' => $ikasleak]);
    }

    public function show(string $id)
    {
        foreach ($this->ikasleak as $ikasle){
            if ($ikasle['id'] == $id){
                return view('students.show', ['ikaslea' => $ikasle]);
            }
        }
        abort(404, 'Ikaslea ez da existitzen');
    }
}
