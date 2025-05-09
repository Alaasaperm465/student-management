@extends('layout.header')
@section('content')

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div class="col-md-13">
         <div class="card">
            <div class="card-header">
                <h3>teachers Section</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table cellpadding="10">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->subject }}</td>
                                    <td>
                                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('teachers.show', $teacher) }} " class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                        <a href="{{ route('teachers.edit', $teacher) }}"class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick=" return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ url('/teachers/create') }}" class="btn btn-success btn-sm" title="add new teacher">
                                <i class="fa fa-plus" aria-hidden="true">Add New Teacher</i>
                </a><br>
            </div>
        </div>
    </div>
@endsection
