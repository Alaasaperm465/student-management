@extends('layout.header')
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