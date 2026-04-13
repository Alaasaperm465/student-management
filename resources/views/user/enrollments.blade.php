@extends('layout')

@section('title', 'My Enrollments - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-user-check"></i> My Enrollments
                </h1>
                <p class="text-muted">View your active enrollments and progress</p>
            </div>
        </div>
    </div>

    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> 
        <strong>No enrollments yet!</strong> Start by browsing available courses and enrolling in ones that interest you.
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Your Enrollments
        </div>
        <div class="card-body">
            <div class="text-center py-4">
                <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">You haven't enrolled in any courses yet.</p>
                <a href="{{ route('user.courses') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-right"></i> Browse Courses
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
