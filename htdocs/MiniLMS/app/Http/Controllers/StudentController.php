<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   
    // app/Http/Controllers/StudentController.php

public function index()
{
    // FIX: Fetch ALL students, not just those linked to a user
    $students = \App\Models\Student::latest()->get(); 

    return view('students.index', compact('students'));
}

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'roll_number' => 'required|max:50',
            'program' => 'required|max:255',
        ]);

        auth()->user()->students()->create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        if (auth()->id() !== $student->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if (auth()->id() !== $student->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'roll_number' => 'required|max:50',
            'program' => 'required|max:255',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        if (auth()->id() !== $student->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}