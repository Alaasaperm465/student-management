@extends('layout.header')
@section('content')

<div class="card">
    <div class="card-header">Batches Page</div>
    <div class="card-body">
        <div class="card-body">
            <h6 class="card-title"><strong>Name: </strong>{{ $batches->name }}</h6>
            <p class="card-text"><strong>course: </strong>{{ $batches->course->name }}</p>
            <p class="card-text"><strong>start_date: </strong>{{ $batches->start_date }}</p>
            <a href="{{ route('batches.index') }}">Back to List</a>

        </div>
    </div>
</div>
@endsection