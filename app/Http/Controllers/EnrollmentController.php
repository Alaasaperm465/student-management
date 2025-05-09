<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Enrollments;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollments::all();
        return view('enrollments.index')->with('enrollments' , $enrollments);
    }
    public function create():View
    {
       
        return view('enrollments.create');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        Enrollments::create($input);
        return redirect('enrollments')->with('flash message' , 'Enrollment ADED');
    }
    public function show(string $id)
    {

        $enrollments = Enrollments::findOrFail($id);
        return view('enrollments.show')->with('enrollments',$enrollments);

    }

    public function edit(string $id)
    {
        $enrollments = Enrollments::findOrFail($id);
        return view('enrollments.edit' , compact('enrollments'));
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'batch_id' => 'required',
            'student_id' => 'required',
        ]);

        $enrollments = Enrollments::findOrFail($id);
        $enrollments->update($request->only('name' , 'batch_id' , 'student_id' , 'join_date' , 'fee'));
        return redirect()->route('enrollments.index', $id)->with('success', 'Enrooment updated successfully!');
    }
    public function destroy( $id)
    {
        $enrollment = Enrollments::findOrFail($id);
        $enrollment->delete();
        return redirect()->route('enrollments.index' )->with('success' , 'Enrollment Deleted!');
    }
}
