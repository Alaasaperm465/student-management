@extends('layout.header')
@section('content')


<div class="card">
    <div class="card-header">Create New Teacher</div>
    <div class="card-body">
        <form action="{{ route('teachers.store') }}" method="POST">
            {!! csrf_field() !!}
            <label>Name:</label>
            <input type="text" name="name" id="name" class="form-control"><br>
            <label>Email:</label>
            <input type="email" name="email" id="email"  class="form-control"><br>
            <label>Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control"><br>
            <button type="submit">Add Teacher</button>
        </form>
    </div>
</div>
@endsection
