@extends('layouts.app')

@section('content')
    @if (auth()->user()->role !== 'admin')
        <h1 class="mb-4">Welcome, {{ auth()->user()->name }}!</h1>
        <p>Track your daily expenses easily.</p>
    @endif
    @if (auth()->user()->role === 'admin')
        <h1 class="mb-4">Welcome, {{ auth()->user()->name }}!</h1>
        <p>This is Admin panel.</p>
    @endif
@endsection
