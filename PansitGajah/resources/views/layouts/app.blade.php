<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PansitGajah')</title>

    {{-- Panggil Tailwind CSS & JS via Vite --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>
