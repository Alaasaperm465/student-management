@extends('layout')

@section('title', 'Add Enrollment - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-plus-circle"></i> Add New Enrollment
                </h1>
                <p class="text-muted">Fill in the form below to add a new enrollment</p>
            </div>
            <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Enrollments
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-form"></i> Enrollment Information
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.enrollments.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-id-card"></i> Enrollment Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="batch_id" class="form-label">
                                <i class="fas fa-layer-group"></i> Batch
                            </label>
                            <select class="form-select @error('batch_id') is-invalid @enderror" 
                                    id="batch_id" name="batch_id" required>
                                <option value="">-- Select Batch --</option>
                            </select>
                            @error('batch_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="student_id" class="form-label">
                                <i class="fas fa-user"></i> Student
                            </label>
                            <select class="form-select @error('student_id') is-invalid @enderror" 
                                    id="student_id" name="student_id" required>
                                <option value="">-- Select Student --</option>
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="join_date" class="form-label">
                                <i class="fas fa-calendar"></i> Join Date
                            </label>
                            <input type="date" class="form-control @error('join_date') is-invalid @enderror" 
                                   id="join_date" name="join_date" value="{{ old('join_date') }}" required>
                            @error('join_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fee" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Fee
                            </label>
                            <input type="number" step="0.01" class="form-control @error('fee') is-invalid @enderror" 
                                   id="fee" name="fee" value="{{ old('fee') }}" required>
                            @error('fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Enrollment
                            </button>
                            <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">
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
    <div class="card-header">Add Enrollments Page</div>
    <div class="card-body">
        <form action="{{ url('enrollments') }}" method="post">
            {!! csrf_field() !!}
            <label >Enroll Num : </label><br>
            <input type="text" name="name" id="name" class="form-control"><br>
            <label >Batch_id : </label>
            <input type="text" name="batch_id" id="batch_id" class="form-control"><br>
            <label >Student_id : </label>
            <input type="text" name="student_id" id="student_id" class="form-control"><br>
            <label >Join_date : </label>
            <input type="text" name="join_date" id="join_date" class="form-control"><br>
            <label >Fee : </label>
            <input type="text" name="fee" id="fee" class="form-control"><br>
            <input type="submit" value="SAVE" class="btn btn-success">
        </form>
    </div>
</div>
@include('layout.footer')
@stop