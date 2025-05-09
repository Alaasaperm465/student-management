@extends('layout.header')
@section('content')



    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
<div class="card">
    <div class="card-header">Edit Page</div>
    <div class="card-body">
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $student->name }}" required class="form-conrol"><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ $student->address }}" required class="form-conrol"><br>

            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" value="{{ $student->mobile }}" required class="form-conrol"><br>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
    
</div>
    

    


@endsection