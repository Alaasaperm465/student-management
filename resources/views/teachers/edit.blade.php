@extends('layout')

@section('title', 'Edit Teacher - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-edit"></i> Edit Teacher
                </h1>
                <p class="text-muted">Update teacher information</p>
            </div>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Teachers
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-edit"></i> Teacher Information
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Full Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ $teacher->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email Address
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ $teacher->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">
                                <i class="fas fa-book"></i> Subject
                            </label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                   id="subject" name="subject" value="{{ $teacher->subject }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Teacher
                            </button>
                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
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
        <div class="card-header">Edit Teacher</div>
        <div class="card-body">
            <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name:</label>
            <input type="text" name="name" value="{{ $teacher->name }}" required class="form-conrol"><br>

            <label>Email:</label>
            <input type="email" name="email" value="{{ $teacher->email}}" required class="form-conrol"><br>

            <label>Subject:</label>
            <input type="text" name="subject" value="{{ $teacher->subject}}" required class="form-conrol"><br>

            <button type="submit">Update Teacher</button>
            </form>
        </div>
    </div>
@endsection
