@extends('layouts.master')
@section('title', 'Registration Form')
@section('content')
    <h2>Registration Form</h2>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $e)
            <li>{{$e}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <form action="{{route('register.store')}}" method="POST">
        @csrf
        <label>Name</label>
        <input type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{old('name')}}">
        @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
<br> <br>
        <label>Email</label>
        <input type="email"
        name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{old('email')}}">
        @error('email')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
<br><br>
        <label>Password</label>
        <input type="password"
        name="password"
        class="form-control @error('password') is-invalid @enderror"
        value="{{old('password')}}">
        @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror

<br><br>
        <label>Confirm Password</label>
        <input type="password"
        name="password_confirmation"
        class="form-control @error('password_confirmation') is-invalid @enderror">
        @error('password_confirmation')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        <br>
        <input type="submit" value="Submit">
    </form>
@endsection
