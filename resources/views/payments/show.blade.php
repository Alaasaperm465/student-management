@extends('layout')
@section('title', 'Payment Details - Student Management System')
@section('content')
<div class="container-lg">
    <div class="page-header">
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        <h1 class="page-title"><i class="fas fa-credit-card"></i> Payment Details</h1>
    </div>
    <div class="row"><div class="col-lg-8"><div class="card"><div class="card-header"><i class="fas fa-info-circle"></i> Details</div>
    <div class="card-body">
    <p><strong>Enrollment:</strong> {{ $payment->enrollment->name ?? 'N/A' }}</p>
    <p><strong>Paid Date:</strong> {{ $payment->paid_date }}</p>
    <p><strong>Amount:</strong> <span class="badge bg-success">${{ number_format($payment->amount, 2) }}</span></p>
    </div></div></div></div></div>
@endsection
@section('content')

<div class="card">
    <div class="card-header">Payments Page</div>
    <div class="card-body">
    <p><strong>ENROLL_NAME:</strong> {{ $payments->enrollment->name}}</p>
    <p><strong>PAID_DATE:</strong> {{ $payments->paid_date }}</p>
    <p><strong>AMOUNT:</strong> {{ $payments->amount }}</p>
    <a href="{{ route('admin.payments.index') }}">Back to List</a>
    </div>
</div>

@endsection

