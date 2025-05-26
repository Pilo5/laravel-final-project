@extends('layout', ['title' => 'Login'])

@section('content')
<div class="bg-white shadow-md rounded p-6 max-w-sm mx-auto">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    @if(session('error')) <p class="text-red-600">{{ session('error') }}</p> @endif
    <form method="POST" action="/login">
        @csrf
        <div class="mb-4">
            <label>Username</label>
            <input type="text" name="username" required class="w-full border p-2 rounded">
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" required class="w-full border p-2 rounded">
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-900">Login</button>
    </form>
</div>
@endsection
