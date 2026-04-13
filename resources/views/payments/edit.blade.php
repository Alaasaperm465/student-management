@extends('layout')
@section('title', 'Edit Payment - Student Management System')
@section('content')
<div class="container-lg">
    <div class="page-header">
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        <h1 class="page-title"><i class="fas fa-edit"></i> Edit Payment</h1>
    </div>
    <div class="row"><div class="col-lg-6 offset-lg-3"><div class="card"><div class="card-header"><i class="fas fa-form"></i> Payment Details</div>
    <div class="card-body"><form action="{{ route('payments.update', $payment->id) }}" method="POST">@csrf @method('PUT')
    <input type="date" name="paid_date" class="form-control mb-3" value="{{ $payment->paid_date }}" required>
    <input type="number" step="0.01" name="amount" class="form-control mb-3" value="{{ $payment->amount }}" required>
    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
    </form></div></div></div></div></div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">Edit Payment</div>
        <div class="card-body">
            <form action="{{ route('payments.update', $payments) }}" method="POST">
            @csrf
            @method('PUT')

            <label>ENROLL_NAME:</label>
            <select name="enrollment_id" id="enrollment_id" value="second">
                @foreach ($enrollments as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select><br>
            <label>PAID_DATE:</label>
            <input type="text" name="paid_date" value="{{ $payments->paid_date }}" required class="form-conrol"><br>
            <label>AMOUNT:</label>
            <input type="text" name="amount" value="{{ $payments->amount }}" required class="form-conrol"><br>
            <button type="submit">Update Payment</button>
            </form>
        </div>
    </div>
@endsection
