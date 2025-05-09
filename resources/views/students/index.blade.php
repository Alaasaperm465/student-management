@extends('layout.header')
@section('content')

            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h3>Student Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>
                                            <form action="{{ route('students.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('students.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                                <a href="{{ route('students.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('/students/create') }}" class="btn btn-success btn-sm" title="add new student">
                            <i class="fa fa-plus" aria-hidden="true"> Add New Student</i>
                        </a><br>
                    </div>
                </div>
    </div>

@endsection