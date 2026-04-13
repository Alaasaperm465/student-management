@extends('layout')

@section('title', 'Teachers - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-chalkboard-user"></i> Teachers Management
                </h1>
                <p class="text-muted">Manage all teachers in the system</p>
            </div>
            <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add New Teacher
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Teachers List
        </div>
        <div class="card-body">
            @if($teachers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-user"></i> Name</th>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <th><i class="fas fa-book"></i> Subject</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $loop->iteration }}</span></td>
                                    <td><strong>{{ $teacher->name }}</strong></td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->subject ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.teachers.show', $teacher->id) }}" 
                                               class="btn btn-info btn-sm" title="View Details">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('admin.teachers.edit', $teacher->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" 
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
                    <i class="fas fa-info-circle"></i> No teachers found. <a href="{{ route('admin.teachers.create') }}">Add the first teacher</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
