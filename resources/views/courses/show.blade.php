@extends('layout')

@section('title', 'Course Details - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-book"></i> Course Details
                </h1>
                <p class="text-muted">{{ $course->name }}</p>
            </div>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Courses
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Course Information
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Course Name</label>
                        <p class="h5"><strong>{{ $course->name }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Syllabus</label>
                        <p>{{ $course->syllabus ?? 'Not specified' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Duration</label>
                                <p class="h5">{{ $course->duration ?? 'N/A' }} days</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Price</label>
                                <p class="h5"><span class="badge bg-success">${{ number_format($course->price, 2) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-cogs"></i> Actions
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit"></i> Edit Course
                        </a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg w-100" 
                                    onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash"></i> Delete Course
                            </button>
                        </form>
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-list"></i> View All Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<div class="card">
    <div class="card-header">Course Page</div>
    <div class="card-body">
    <p><strong>Name:</strong> {{ $courses->name}}</p>
    <p><strong>Syllabus:</strong> {{ $courses->syllabus }}</p>
    <p><strong>Duration:</strong> {{ $courses->duration() }}</p>
    <p><strong>Price:</strong> {{ $courses->price }}</p>


    <a href="{{ route('admin.courses.index') }}">Back to List</a>
    </div>
</div>

@endsection

