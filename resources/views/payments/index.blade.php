@extends('layout.header')
@section('content')

            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h3>Payments Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ENROLL_NAME</th>
                                        <th>PAID_DATE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->enrollment->name }}</td>
                                        <td>{{ $item->paid_date }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            <a href="{{ route('payments.show', $item->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                            <a href="{{ route('payments.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                            <a href="{{ route('payments.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this payment?');"><i class="bi bi-trash"></i> Delete</a>
                                            <a href="{{ url('/report/report1/'.$item->id) }}" title="Edit Payment"><button class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i>Print</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('/payments/create') }}" class="btn btn-success btn-sm" title="add new payment">
                            <i class="fa fa-plus" aria-hidden="true"> Add New Payments</i>
                        </a><br>
                    </div>
                </div>
    </div>

@endsection