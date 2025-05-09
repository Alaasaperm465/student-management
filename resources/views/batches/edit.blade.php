@extends('layout.header')
@section('content')



    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
<div class="card">
    <div class="card-header">Edit Batches</div>
    <div class="card-body">
        <form action="{{ route('batches.update', $batches->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" value="{{ $batches->name }}" required class="form-conrol"><br>

            <label for="address">Course Name :</label>
            <input type="text" id="course_id" name="course_id" value="{{ $batches->course_id }}" required class="form-conrol"><br>

            <label for="mobile">Start Date:</label>
            <input type="text" id="start_date" name="start_date" value="{{ $batches->start_date }}" required class="form-conrol"><br>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
    
</div>
    

    


@endsection