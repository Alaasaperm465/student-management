@extends('layout')

@section('title', 'Enrollments - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-clipboard-list"></i> Enrollments Management
                </h1>
                <p class="text-muted">Manage all student enrollments</p>
            </div>
            <a href="{{ route('admin.enrollments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Enrollment
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Enrollments List
        </div>
        <div class="card-body">
            @if($enrollments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-id-card"></i> Enrollment #</th>
                                <th><i class="fas fa-layer-group"></i> Batch</th>
                                <th><i class="fas fa-user"></i> Student</th>
                                <th><i class="fas fa-calendar"></i> Join Date</th>
                                <th><i class="fas fa-dollar-sign"></i> Fee</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollments as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $loop->iteration }}</span></td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->batch->name ?? 'N/A' }}</td>
                                <td>{{ $item->student->name ?? 'N/A' }}</td>
                                <td>{{ $item->join_date ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        ${{ number_format($item->fee, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.enrollments.show', $item->id) }}" 
                                           class="btn btn-info btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.enrollments.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.enrollments.destroy', $item->id) }}" 
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
                    <i class="fas fa-info-circle"></i> No enrollments found. <a href="{{ route('admin.enrollments.create') }}">Create the first enrollment</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
