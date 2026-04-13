@extends('layout')

@section('title', 'Student Details - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-user-circle"></i> Student Details
                </h1>
                <p class="text-muted">{{ $students->name }}</p>
            </div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Students
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
                        <p class="h5"><strong>{{ $students->name }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Address</label>
                        <p class="h5">{{ $students->address ?? 'Not specified' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Mobile Number</label>
                        <p class="h5">
                            <a href="tel:{{ $students->mobile }}">
                                {{ $students->mobile ?? 'Not specified' }}
                            </a>
                        </p>
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
                        <a href="{{ route('students.edit', $students->id) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit"></i> Edit Student
                        </a>
                        <form action="{{ route('admin.students.destroy', $students->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg w-100" 
                                    onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash"></i> Delete Student
                            </button>
                        </form>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-list"></i> View All Students
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection