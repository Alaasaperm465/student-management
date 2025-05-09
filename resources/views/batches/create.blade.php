@extends('layout.header')
@section('content')


<div class="card">
    <div class="card-header">Add Batches</div>
    <div class="card-body">
        <form action="{{ url('batches') }}" method="post">
            {!! csrf_field() !!}
            <label >Batches : </label><br>
            <input type="text" name="name" id="name" class="form-control"><br>
            <label >Course Name: </label>
            <select name="course_id" id="course_id" class="form-control" value=" ">
                @foreach ($courses as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <label >Start Date: </label>
            <input type="text" name="start_date" id="start_date" class="form-control"><br>
            <input type="submit" value="SAVE" class="btn btn-success">
        </form>
    </div>
</div>
@stop


<!--<input type="text" name="course_id" id="course_id" class="form-control"><br>-->