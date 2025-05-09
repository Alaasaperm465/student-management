@extends('layout.header')
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
