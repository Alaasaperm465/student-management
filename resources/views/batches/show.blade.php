@extends('layout')

@section('title', 'Batch Details - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-layer-group"></i> Batch Details
                </h1>
                <p class="text-muted">{{ $batch->name }}</p>
            </div>
            <a href="{{ route('batches.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Batches
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Batch Information
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-muted">Batch Name</label>
                        <p class="h5"><strong>{{ $batch->name }}</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Course</label>
                        <p class="h5">{{ $batch->course->name ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Start Date</label>
                        <p class="h5">{{ $batch->start_date ?? 'N/A' }}</p>
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
                        <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit"></i> Edit Batch
                        </a>
                        <form action="{{ route('batches.destroy', $batch->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg w-100" 
                                    onclick="return confirm('Are you sure?');">
                                <i class="fas fa-trash"></i> Delete Batch
                            </button>
                        </form>
                        <a href="{{ route('batches.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-list"></i> View All Batches
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
    <div class="card-header">Batches Page</div>
    <div class="card-body">
        <div class="card-body">
            <h6 class="card-title"><strong>Name: </strong>{{ $batches->name }}</h6>
            <p class="card-text"><strong>course: </strong>{{ $batches->course->name }}</p>
            <p class="card-text"><strong>start_date: </strong>{{ $batches->start_date }}</p>
            <a href="{{ route('batches.index') }}">Back to List</a>

        </div>
    </div>
</div>
@endsection