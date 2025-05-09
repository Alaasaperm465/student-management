@extends('layout.header')
@section('content')

<div class="card">
    <div class="card-header">Payments Page</div>
    <div class="card-body">
    <p><strong>ENROLL_NAME:</strong> {{ $payments->enrollment->name}}</p>
    <p><strong>PAID_DATE:</strong> {{ $payments->paid_date }}</p>
    <p><strong>AMOUNT:</strong> {{ $payments->amount }}</p>
    <a href="{{ route('payments.index') }}">Back to List</a>
    </div>
</div>

@endsection

