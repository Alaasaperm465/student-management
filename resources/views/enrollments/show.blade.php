@extends('layout.header')
@section('content')

<div class="card">
    <div class="card-header">Enrollments Page</div>
    <div class="card-body">
    <p><strong>Enroll Num :</strong> {{ $enrollments->name}}</p>
    <p><strong>Batch_id : </strong> {{ $enrollments->batch_id }}</p>
    <p><strong>Student_id : </strong> {{ $enrollments->student_id }}</p>
    <p><strong>Join_date : </strong> {{ $enrollments->join_date }}</p>
    <p><strong>Fee : </strong> {{ $enrollments->fee }}</p>


    <a href="{{ route('enrollments.index') }}">Back to List</a>
    </div>
</div>

@endsection

