@extends('layout.header')
@section('content')

<div class="card">
    <div class="card-header">Teacher Page</div>
    <div class="card-body">
    <p><strong>Name:</strong> {{ $teacher->name }}</p>
    <p><strong>Email:</strong> {{ $teacher->email }}</p>
    <p><strong>Subject:</strong> {{ $teacher->subject }}</p>

    <a href="{{ route('teachers.index') }}">Back to List</a>
    </div>
</div>

@endsection

