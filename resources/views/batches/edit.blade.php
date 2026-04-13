@extends('layout')

@section('title', 'Edit Batch - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-edit"></i> Edit Batch
                </h1>
                <p class="text-muted">Update batch information</p>
            </div>
            <a href="{{ route('batches.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Batches
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-layer-group"></i> Batch Information
                </div>
                <div class="card-body">
                    <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-layer-group"></i> Batch Name
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ $batch->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course_id" class="form-label">
                                <i class="fas fa-book"></i> Course
                            </label>
                            <select class="form-select @error('course_id') is-invalid @enderror" 
                                    id="course_id" name="course_id" required>
                                @foreach ($courses as $id => $name)
                                    <option value="{{ $id }}" {{ $batch->course_id == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">
                                <i class="fas fa-calendar"></i> Start Date
                            </label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" value="{{ $batch->start_date }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Batch
                            </button>
                            <a href="{{ route('batches.index') }}" class="btn btn-secondary">
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



    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
<div class="card">
    <div class="card-header">Edit Batches</div>
    <div class="card-body">
        <form action="{{ route('batches.update', $batches->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" value="{{ $batches->name }}" required class="form-conrol"><br>

            <label for="address">Course Name :</label>
            <input type="text" id="course_id" name="course_id" value="{{ $batches->course_id }}" required class="form-conrol"><br>

            <label for="mobile">Start Date:</label>
            <input type="text" id="start_date" name="start_date" value="{{ $batches->start_date }}" required class="form-conrol"><br>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
    
</div>
    

    


@endsection