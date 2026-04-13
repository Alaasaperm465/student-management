@extends('layout')

@section('title', 'Payments - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-credit-card"></i> Payments Management
                </h1>
                <p class="text-muted">Manage all payment transactions</p>
            </div>
            <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Payment
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Payments List
        </div>
        <div class="card-body">
            @if($payments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-id-card"></i> Enrollment</th>
                                <th><i class="fas fa-calendar"></i> Paid Date</th>
                                <th><i class="fas fa-dollar-sign"></i> Amount</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $item)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $loop->iteration }}</span></td>
                                <td><strong>{{ $item->enrollment->name ?? 'N/A' }}</strong></td>
                                <td>{{ $item->paid_date ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        ${{ number_format($item->amount, 2) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.payments.show', $item->id) }}" 
                                           class="btn btn-info btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.payments.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ url('/report/report1/'.$item->id) }}" 
                                           class="btn btn-success btn-sm" title="Print Receipt">
                                            <i class="fas fa-print"></i> Print
                                        </a>
                                        <form action="{{ route('admin.payments.destroy', $item->id) }}" 
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
                    <i class="fas fa-info-circle"></i> No payments found. <a href="{{ route('admin.payments.create') }}">Record the first payment</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection