@extends('layout.header')
@section('content')

            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h3>Batches Section</h3>
                    </div>
                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Start_date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batches as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>
                                            <form action="{{ route('batches.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('batches.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                                <a href="{{ route('batches.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('/batches/create') }}" class="btn btn-success btn-sm" title="add new student">
                            <i class="fa fa-plus" aria-hidden="true"> Add New Batch</i>
                        </a><br>
                    </div>
                </div>
    </div>

@endsection