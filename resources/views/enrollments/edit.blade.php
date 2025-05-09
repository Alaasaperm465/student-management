@extends('layout.header')
@section('content')
    <div class="card">
        <div class="card-header">Edit Enrollment</div>
        <div class="card-body">
            <form action="{{ route('enrollments.update', $enrollments) }}" method="POST">
            @csrf
            @method('PUT')

            <label>enroll Num : </label>
            <input type="text" name="name" value="{{ $enrollments->name}}" required class="form-conrol"><br>
            <label>Batch_id : </label>
            <input type="text" name="batch_id" value="{{ $enrollments->batch_id }}" required class="form-conrol"><br>
            <label>Student_id : </label>
            <input type="text" name="student_id" value="{{ $enrollments->student_id }}" required class="form-conrol"><br>
            <label>Join_date : </label>
            <input type="text" name="join_date" value="{{ $enrollments->join_date }}" required class="form-conrol"><br>
            <label>Fee : </label>
            <input type="text" name="fee" value="{{ $enrollments->fee }}" required class="form-conrol"><br>
            <button type="submit">Update Course</button>
            </form>
        </div>
    </div>
@endsection
