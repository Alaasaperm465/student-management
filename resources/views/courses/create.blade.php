@extends('layout')

@section('title', 'Add Course - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-plus-circle"></i> Add New Course
                </h1>
                <p class="text-muted">Fill in the form below to add a new course</p>
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
                    <i class="fas fa-form"></i> Course Information
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.courses.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-book"></i> Course Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="syllabus" class="form-label">
                                <i class="fas fa-align-left"></i> Syllabus
                            </label>
                            <textarea class="form-control @error('syllabus') is-invalid @enderror" 
                                      id="syllabus" name="syllabus" rows="3">{{ old('syllabus') }}</textarea>
                            @error('syllabus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">
                                <i class="fas fa-clock"></i> Duration (Days)
                            </label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration') }}" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Price
                            </label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Course
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