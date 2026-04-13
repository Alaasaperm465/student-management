@extends('layout')

@section('title', 'Edit Course - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-edit"></i> Edit Course
                </h1>
                <p class="text-muted">Update course information</p>
            </div>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Courses
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-book-edit"></i> Course Information
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-book"></i> Course Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ $course->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="syllabus" class="form-label">
                                <i class="fas fa-align-left"></i> Syllabus
                            </label>
                            <textarea class="form-control @error('syllabus') is-invalid @enderror" 
                                      id="syllabus" name="syllabus" rows="3">{{ $course->syllabus }}</textarea>
                            @error('syllabus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">
                                <i class="fas fa-clock"></i> Duration (Days)
                            </label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ $course->duration }}" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Price
                            </label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ $course->price }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Course
                            </button>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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


