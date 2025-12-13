<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class CourseController extends Controller
{
    // READ (Index): Display a list of courses
    public function index()
{
    $courses = auth()->user()->courses()->latest()->get();
    return view('courses.index', compact('courses'));
}

    // CREATE (Create): Show the form to create a new course
    public function create()
    {
        return view('courses.create');
    }

    // STORE (Store): Handle the creation of a new course
    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'code' => 'required|unique:courses|max:10',
            'credits' => 'required|integer|min:1',
        ]);

        // 2. Creation (automatically links course to the logged-in user via the relationship)
        auth()->user()->courses()->create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    // EDIT (Edit/Update): Show the form to edit AND UPDATE an existing course
    public function edit(Course $course)
    {
        // **Authorization Check:** Only the owner can edit/update
        if (auth()->id() !== $course->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if (auth()->id() !== $course->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // 1. Validation (Ignore unique code check for the current course itself)
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'code' => 'required|max:10|unique:courses,code,' . $course->id,
            'credits' => 'required|integer|min:1',
        ]);

        // 2. Update
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    // DELETE (Destroy): Delete a course
    public function destroy(Course $course)
    {
        if (auth()->id() !== $course->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}