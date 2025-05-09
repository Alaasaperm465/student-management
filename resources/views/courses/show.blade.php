@extends('layout.header')
@section('content')

<div class="card">
    <div class="card-header">Course Page</div>
    <div class="card-body">
    <p><strong>Name:</strong> {{ $courses->name}}</p>
    <p><strong>Syllabus:</strong> {{ $courses->syllabus }}</p>
    <p><strong>Duration:</strong> {{ $courses->duration() }}</p>
    <p><strong>Price:</strong> {{ $courses->price }}</p>


    <a href="{{ route('courses.index') }}">Back to List</a>
    </div>
</div>

@endsection

