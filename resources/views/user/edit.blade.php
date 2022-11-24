@extends('layout.main')

@section('title')
Update User
@endsection

@section('content')

<div class="container">
    <h2 class="text-center mt-3"> Update User</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="text" class="form-control" required id="name" name="name" value="{{ $user->name }}">

        </div>
        <div class="mb-3">
            <label for="Gender" class="form-label">Gender</label>
            <select class="form-control" name="gender" required>
                <option value="Male" {{ $user->gender=="Male" ? "selected" : ''}}>Male</option>
                <option value="Female" {{ $user->gender=="Female" ? "selected" : ''}}>Female</option>
            </select>

        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" required id="email" name="email" value="{{ $user->email }}">

        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" required id="phone" name="phone" value="{{ $user->phone }}">

        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" required id="location" name="location" value="{{ $user->location }}">

        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Picture</label><br>
            <img src="{{ $user->picture }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('index') }}"> Back </a>
    </form>
</div>
@endsection