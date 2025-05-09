@extends('layout.header')
@section('content')


<div class="card">
    <div class="card-header">Add Enrollments Page</div>
    <div class="card-body">
        <form action="{{ url('enrollments') }}" method="post">
            {!! csrf_field() !!}
            <label >Enroll Num : </label><br>
            <input type="text" name="name" id="name" class="form-control"><br>
            <label >Batch_id : </label>
            <input type="text" name="batch_id" id="batch_id" class="form-control"><br>
            <label >Student_id : </label>
            <input type="text" name="student_id" id="student_id" class="form-control"><br>
            <label >Join_date : </label>
            <input type="text" name="join_date" id="join_date" class="form-control"><br>
            <label >Fee : </label>
            <input type="text" name="fee" id="fee" class="form-control"><br>
            <input type="submit" value="SAVE" class="btn btn-success">
        </form>
    </div>
</div>
@include('layout.footer')
@stop