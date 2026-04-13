@extends('layout')

@section('title', 'Students - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-users"></i> Students Management
                </h1>
                <p class="text-muted">Manage all students in the system</p>
            </div>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Add New Student
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Students List
        </div>
        <div class="card-body">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-user"></i> Name</th>
                                <th><i class="fas fa-map-marker-alt"></i> Address</th>
                                <th><i class="fas fa-phone"></i> Mobile</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $loop->iteration }}</span></td>
                                <td>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td>{{ $item->address ?? 'N/A' }}</td>
                                <td>
                                    <a href="tel:{{ $item->mobile }}">
                                        {{ $item->mobile ?? 'N/A' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.students.show', $item->id) }}" 
                                           class="btn btn-info btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.students.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $item->id) }}" 
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
                    <i class="fas fa-info-circle"></i> No students found. <a href="{{ route('admin.students.create') }}">Create the first student</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection