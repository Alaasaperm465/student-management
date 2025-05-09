@extends('layout.header')
@section('content')
    <div class="card">
        <div class="card-header">Edit Teacher</div>
        <div class="card-body">
            <form action="{{ route('teachers.update', $teacher) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name:</label>
            <input type="text" name="name" value="{{ $teacher->name }}" required class="form-conrol"><br>

            <label>Email:</label>
            <input type="email" name="email" value="{{ $teacher->email}}" required class="form-conrol"><br>

            <label>Subject:</label>
            <input type="text" name="subject" value="{{ $teacher->subject}}" required class="form-conrol"><br>

            <button type="submit">Update Teacher</button>
            </form>
        </div>
    </div>
@endsection
