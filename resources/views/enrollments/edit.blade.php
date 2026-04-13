@extends('layout')
@section('title', 'Edit Enrollment - Student Management System')
@section('content')
<div class="container-lg">
    <div class="page-header">
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        <h1 class="page-title"><i class="fas fa-edit"></i> Edit Enrollment</h1>
    </div>
    <div class="row"><div class="col-lg-6 offset-lg-3"><div class="card"><div class="card-header"><i class="fas fa-form"></i> Enrollment Details</div>
    <div class="card-body"><form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">@csrf @method('PUT')
    <input type="text" name="name" class="form-control mb-3" value="{{ $enrollment->name }}" required>
    <input type="date" name="join_date" class="form-control mb-3" value="{{ $enrollment->join_date }}" required>
    <input type="number" step="0.01" name="fee" class="form-control mb-3" value="{{ $enrollment->fee }}" required>
    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
    </form></div></div></div></div></div>
@endsection
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
