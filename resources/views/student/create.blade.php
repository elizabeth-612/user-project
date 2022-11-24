@extends('layout.main')

@section('title')
Registration form
@endsection

@section('content')

<div class="container">
    <h2 class="text-center mt-3">Student Registration Form</h2>
    <form action="{{ route('student.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="text" class="form-control" required id="name" name="name" value="{{ old('name') }}">

        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" required id="email" name="email" value="{{ old('email') }}">

        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" required id="city" name="city" value="{{ old('city') }}">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('student.index') }}"> Back </a>
    </form>
</div>
@endsection