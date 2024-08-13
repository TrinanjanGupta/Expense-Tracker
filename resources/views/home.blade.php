@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Welcome, {{ auth()->user()->name }}!</h1>
    <p>Track your daily expenses easily.</p>
@endsection
