@extends('layout.header')
@section('content')

            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h3>Enrollments Section</h3>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Enroll Num</th>
                                        <th>Batch</th>
                                        <th>Student</th>
                                        <th>Join_date</th>
                                        <th>Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enrollments as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->batch->name }}</td>
                                        <td>{{ $item->student->name }}</td>
                                        <td>{{ $item->join_date }}</td>
                                        <td>{{ $item->fee }}</td>
                                        <td>
                                            <form action="{{ route('enrollments.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('enrollments.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                                <a href="{{ route('enrollments.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this enrollment?');"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('/enrollments/create') }}" class="btn btn-success btn-sm" title="add new student">
                            <i class="fa fa-plus" aria-hidden="true"> Add New Enrollment</i>
                        </a><br>
                    </div>
                </div>
    </div>

@endsection