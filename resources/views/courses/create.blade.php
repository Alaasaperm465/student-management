@extends('layout.header')
@section('content')


<div class="card">
    <div class="card-header">Add Course Page</div>
    <div class="card-body">
        <form action="{{ url('courses') }}" method="post">
            {!! csrf_field() !!}
            <label >Name: </label><br>
            <input type="text" name="name" id="name" class="form-control"><br>
            <label >Syllabus: </label>
            <input type="text" name="syllabus" id="syllabus" class="form-control"><br>
            <label >Duration: </label>
            <input type="text" name="duration" id="duration" class="form-control"><br>
            <label >Price: </label>
            <input type="text" name="price" id="price" class="form-control"><br>
            <input type="submit" value="SAVE" class="btn btn-success">
        </form>
    </div>
</div>

@stop