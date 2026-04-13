@extends('layout')

@section('title', 'Add Payment - Student Management System')

@section('content')
<div class="container-lg">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-plus-circle"></i> Add New Payment
                </h1>
                <p class="text-muted">Record a new payment transaction</p>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Payments
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-form"></i> Payment Information
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="enrollment_id" class="form-label">
                                <i class="fas fa-id-card"></i> Enrollment
                            </label>
                            <select class="form-select @error('enrollment_id') is-invalid @enderror" 
                                    id="enrollment_id" name="enrollment_id" required>
                                <option value="">-- Select Enrollment --</option>
                            </select>
                            @error('enrollment_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="paid_date" class="form-label">
                                <i class="fas fa-calendar"></i> Payment Date
                            </label>
                            <input type="date" class="form-control @error('paid_date') is-invalid @enderror" 
                                   id="paid_date" name="paid_date" value="{{ old('paid_date', date('Y-m-d')) }}" required>
                            @error('paid_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">
                                <i class="fas fa-dollar-sign"></i> Amount
                            </label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Payment
                            </button>
                            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')


<div class="card">
    <div class="card-header">Add Payments</div>
    <div class="card-body">
        <form action="{{ url('payments') }}" method="post">
            {!! csrf_field() !!}
            <label >ID ENROLLMENT: </label><br>
            <select name="enrollment_id" id="enrollment_id" class="form-control" value="second">
                @foreach ($enrollments as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <label >DATE: </label>
            <input type="text" name="paid_date" id="paid_date" class="form-control"><br>
            <label >AMOUNT: </label>
            <input type="text" name="amount" id="amount" class="form-control"><br>

            <input type="submit" value="SAVE" class="btn btn-success">
        </form>
    </div>
</div>
@stop