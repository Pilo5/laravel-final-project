@extends('layout', ['title' => 'User Dashboard'])

@section('content')
<div class="bg-white shadow-md rounded p-6 max-w-xl mx-auto">
    <div class="flex items-center space-x-4">
        <img src="{{ asset($user->employee->image_path ?? 'images/default.png') }}" class="w-16 h-16 rounded-full" alt="Profile">
        <div>
            <h2 class="text-xl font-semibold">{{ $user->employee->first_name }} {{ $user->employee->last_name }}</h2>
            <p class="text-sm text-gray-600">{{ $user->username }}</p>
        </div>
    </div>
    <div class="mt-6">
        <a href="/update-password" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update Password</a>
    </div>
</div>
@endsection
