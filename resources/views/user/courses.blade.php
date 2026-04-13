@extends('layout')

@section('title', 'Available Courses - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-book"></i> Available Courses
                </h1>
                <p class="text-muted">Browse and enroll in available courses</p>
            </div>
        </div>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> 
        <strong>Welcome!</strong> You are logged in as a <strong>Student User</strong>. 
        You can browse and enroll in available courses here.
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-book"></i> Web Development
                </div>
                <div class="card-body">
                    <p class="text-muted">Learn modern web development</p>
                    <h4 class="text-success">$99.99</h4>
                    <button class="btn btn-primary btn-sm mt-3">
                        <i class="fas fa-check-circle"></i> Enroll Now
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-book"></i> Python Programming
                </div>
                <div class="card-body">
                    <p class="text-muted">Master Python programming</p>
                    <h4 class="text-success">$79.99</h4>
                    <button class="btn btn-primary btn-sm mt-3">
                        <i class="fas fa-check-circle"></i> Enroll Now
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <i class="fas fa-book"></i> Data Science
                </div>
                <div class="card-body">
                    <p class="text-muted">Learn data science basics</p>
                    <h4 class="text-success">$129.99</h4>
                    <button class="btn btn-primary btn-sm mt-3">
                        <i class="fas fa-check-circle"></i> Enroll Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
