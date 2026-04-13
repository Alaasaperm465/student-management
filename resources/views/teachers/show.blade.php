@extends('layout')

@section('title', 'Teacher Details - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-user-circle"></i> Teacher Details
                </h1>
                <p class="text-muted">{{ $teacher->name }}</p>
            </div>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Teachers
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Personal Information
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Full Name</label>
                        <p class="h5"><strong>{{ $teacher->name }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Email Address</label>
                        <p class="h5">
                            <a href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Subject</label>
                        <p class="h5">{{ $teacher->subject ?? 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-cogs"></i> Actions
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit"></i> Edit Teacher
                        </a>
                        <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg w-100" 
                                    onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash"></i> Delete Teacher
                            </button>
                        </form>
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-list"></i> View All Teachers
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
    <div class="card-header">Teacher Page</div>
    <div class="card-body">
    <p><strong>Name:</strong> {{ $teacher->name }}</p>
    <p><strong>Email:</strong> {{ $teacher->email }}</p>
    <p><strong>Subject:</strong> {{ $teacher->subject }}</p>

    <a href="{{ route('admin.teachers.index') }}">Back to List</a>
    </div>
</div>

@endsection

