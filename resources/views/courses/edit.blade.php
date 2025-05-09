@extends('layout.header')
@section('content')
    <div class="card">
        <div class="card-header">Edit Course</div>
        <div class="card-body">
            <form action="{{ route('courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name:</label>
            <input type="text" name="name" value="{{ $course->name}}" required class="form-conrol"><br>
            <label>Syllabus:</label>
            <input type="text" name="syllabus" value="{{ $course->syllabus }}" required class="form-conrol"><br>
            <label>Duration:</label>
            <input type="text" name="duration" value="{{ $course->duration }}" required class="form-conrol"><br>
            <label>Price:</label>
            <input type="text" name="price" value="{{ $course->price }}" required class="form-conrol"><br>
            <button type="submit">Update Course</button>
            </form>
        </div>
    </div>
@endsection


