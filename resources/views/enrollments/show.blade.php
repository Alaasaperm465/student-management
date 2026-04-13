@extends('layout')
@section('title', 'Enrollment Details - Student Management System')
@section('content')
<div class="container-lg">
    <div class="page-header">
        <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        <h1 class="page-title"><i class="fas fa-clipboard-list"></i> Enrollment Details</h1>
    </div>
    <div class="row"><div class="col-lg-8"><div class="card"><div class="card-header"><i class="fas fa-info-circle"></i> Details</div>
    <div class="card-body">
    <p><strong>Enrollment:</strong> {{ $enrollment->name }}</p>
    <p><strong>Batch:</strong> {{ $enrollment->batch->name ?? 'N/A' }}</p>
    <p><strong>Student:</strong> {{ $enrollment->student->name ?? 'N/A' }}</p>
    <p><strong>Join Date:</strong> {{ $enrollment->join_date }}</p>
    <p><strong>Fee:</strong> ${{ number_format($enrollment->fee, 2) }}</p>
    </div></div></div></div></div>
@endsection
@section('content')

<div class="card">
    <div class="card-header">Enrollments Page</div>
    <div class="card-body">
    <p><strong>Enroll Num :</strong> {{ $enrollments->name}}</p>
    <p><strong>Batch_id : </strong> {{ $enrollments->batch_id }}</p>
    <p><strong>Student_id : </strong> {{ $enrollments->student_id }}</p>
    <p><strong>Join_date : </strong> {{ $enrollments->join_date }}</p>
    <p><strong>Fee : </strong> {{ $enrollments->fee }}</p>


    <a href="{{ route('admin.enrollments.index') }}">Back to List</a>
    </div>
</div>

@endsection

