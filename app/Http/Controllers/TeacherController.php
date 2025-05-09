<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Teacher;
class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }
    public function create()
    {
        return view('teachers.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'subject' => 'required|string|max:255',
        ]);

        Teacher::create($request->only(['name', 'email', 'subject']));

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }
    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:teachers,email,' . $teacher->id,
            'subject'   => 'required|string|max:255',
        ]);

        $teacher->update($request->only(['name', 'email', 'subject']));
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }
    public function destroy(string $id)
    {
        Teacher::destroy($id);
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
