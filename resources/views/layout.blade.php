<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Laravel App' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-700 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Employee Portal</h1>
        @if(session()->has('loggedUser'))
            <a href="/logout" class="bg-red-500 px-4 py-2 rounded hover:bg-red-700">Logout</a>
        @endif
    </header>
    <main class="container mx-auto p-6">
        @yield('content')
    </main>
    <footer class="bg-blue-700 text-white text-center py-4 mt-10">
        &copy; {{ date('Y') }} Laravel Final Project
    </footer>
</body>
</html>
