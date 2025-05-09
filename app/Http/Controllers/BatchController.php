<?php

namespace App\Http\Controllers;

use App\Models\batch;
use App\Models\course;
use Illuminate\Bus\Batch as BusBatch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class batchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $batches = batch::all();
        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $courses = course::pluck('name' , 'id');
        return view('batches.create' , compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->all();
        batch::create($input);
        return redirect('batches')->with('flash message' , 'Batch Aded');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id):view   
    {
        $batche = batch::findOrFail($id);
        return view('batches.show')->with('batches',$batche);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        $batche = batch::findOrFail($id);
        return view('batches.edit')->with('batches' , $batche);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        $batch = batch::findOrFail($id);
        $batch->update($request->only(['name', 'course_id', 'start_date']));

        return redirect()->route('batches.idex', $id)
                         ->with('success', 'Batche updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        $batch = batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('batches.index')->with('success', 'Batche deleted successfully!');
    }
}
