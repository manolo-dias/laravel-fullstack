<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Market</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="{{ asset('js/alert.js') }}"></script>
</head>
<body class="bg-gray-900 ">
<div class="min-h-screen">
    <x-nav></x-nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

</div>
</body>
</html>
