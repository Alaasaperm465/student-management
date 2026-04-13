@extends('layout')

@section('title', 'Batches - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-layer-group"></i> Batches Management
                </h1>
                <p class="text-muted">Manage all batches in the system</p>
            </div>
            <a href="{{ route('admin.batches.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Batch
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Batches List
        </div>
        <div class="card-body">
            @if($batches->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-layer-group"></i> Batch Name</th>
                                <th><i class="fas fa-book"></i> Course</th>
                                <th><i class="fas fa-calendar"></i> Start Date</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batches as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $loop->iteration }}</span></td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->course->name ?? 'N/A' }}</td>
                                <td>{{ $item->start_date ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.batches.show', $item->id) }}" 
                                           class="btn btn-info btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.batches.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.batches.destroy', $item->id) }}" 
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure?');" title="Delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No batches found. <a href="{{ route('admin.batches.create') }}">Create the first batch</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

