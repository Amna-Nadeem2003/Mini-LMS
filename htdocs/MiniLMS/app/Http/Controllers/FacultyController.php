<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = auth()->user()->faculties()->latest()->get();
        return view('faculties.index', compact('faculties'));
    }

    public function create()
    {
        return view('faculties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'department' => 'required|max:255',
        ]);

        auth()->user()->faculties()->create($request->all());

        return redirect()->route('faculties.index')->with('success', 'Faculty member added successfully!');
    }

    public function edit(Faculty $faculty)
    {
        if (auth()->id() !== $faculty->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('faculties.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        if (auth()->id() !== $faculty->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'department' => 'required|max:255',
        ]);

        $faculty->update($request->all());

        return redirect()->route('faculties.index')->with('success', 'Faculty member updated successfully!');
    }

    public function destroy(Faculty $faculty)
    {
        if (auth()->id() !== $faculty->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $faculty->delete();
        return redirect()->route('faculties.index')->with('success', 'Faculty member deleted successfully!');
    }
}