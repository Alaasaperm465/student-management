<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\course;


class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $courses = course::all();
        return view('courses.index', compact('courses'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = course::pluck('name','id');
        return view('courses.create' , compact('courses'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string',
            'duration' => 'required|string|max:255',
        ]);
        course::create($request->only(['name', 'syllabus', 'duration','price']));
        return redirect('courses')->with('flash message' , 'Student Aded');
    }

    /**
     * Display the specified resource.
     */
    public function show(course $courses)
    {
        return view('courses.show')->with('courses',$courses);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(course $course)
    {
        return view('courses.edite', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, course $course)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'syllabus'      => 'required' ,
            'duration'      => 'required|string|max:255',
            'price'         =>'required|string',
        ]);
        $course->update($request->only(['name', 'syllabus', 'duration','price']));
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Courses deleted successfully.');
    }
}
