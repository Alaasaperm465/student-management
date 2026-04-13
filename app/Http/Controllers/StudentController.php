<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\students;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $students = students::all();
        return view('students.index',compact('students'));
    }
//compact('students'

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->all();
        students::create($input);
        return redirect('students')->with('flash message' , 'Student Aded');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = students::findOrFail($id);
        return view('students.show')->with('students',$students);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Students::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // Handle form submission and update student
    public function update(Request $request, $id)
    {
       

        $student = Students::findOrFail($id);
        $student->update($request->only(['name', 'address', 'mobile']));

        return redirect('students')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Students::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }
}
