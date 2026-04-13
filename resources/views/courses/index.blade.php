@extends('layout')

@section('title', 'Courses - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-book"></i> Courses Management
                </h1>
                <p class="text-muted">Manage all courses in the system</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Course
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Courses List
        </div>
        <div class="card-body">
            @if($courses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-book"></i> Name</th>
                                <th><i class="fas fa-align-left"></i> Syllabus</th>
                                <th><i class="fas fa-clock"></i> Duration</th>
                                <th><i class="fas fa-dollar-sign"></i> Price</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $loop->iteration }}</span></td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->syllabus ?? 'N/A' }}</td>
                                <td>{{ $item->duration() ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        ${{ number_format((float)$item->price, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.courses.show', $item->id) }}" 
                                           class="btn btn-info btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.courses.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.courses.destroy', $item->id) }}" 
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
                    <i class="fas fa-info-circle"></i> No courses found. <a href="{{ route('admin.courses.create') }}">Create the first course</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
