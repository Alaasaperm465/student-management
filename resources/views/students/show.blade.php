@extends('layout.header')
@section('content')

<div class="card ">
    <div class="card-header">Student Page</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title"><strong>Name: </strong>{{ $students->name }}</h5>
            <p class="card-text"><strong>Address: </strong>{{ $students->address }}</p>
            <p class="card-text"><strong>Mobile: </strong>{{ $students->mobile }}</p>
            <a href="{{ route('students.index') }}">Back to List</a>

        </div>
    </div>
</div>
@endsection