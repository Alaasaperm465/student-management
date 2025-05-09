@extends('layout.header')
@section('content')


<div class="card">
    <div class="card-header">Add Studen Page</div>
    <div class="card-body">
        <form action="{{ url('students') }}" method="post">
            {!! csrf_field() !!}
            <label >Name: </label><br>
            <input type="text" name="name" id="name" class="form-control"><br>
            <label >Adress: </label>
            <input type="text" name="address" id="address" class="form-control"><br>
            <label >Mobile: </label>
            <input type="text" name="mobile" id="mobile" class="form-control"><br>
            <input type="submit" value="SAVE" class="btn btn-success">
        </form>
    </div>
</div>
@stop