<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        @yield('title', 'Kopi CeTe')
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    {{-- ===============================
    GOOGLE FONT
    ================================ --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    {{-- ===============================
    BOOTSTRAP
    ================================ --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    {{-- ===============================
    BOOTSTRAP ICON
    ================================ --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    {{-- ===============================
    CUSTOM CSS
    ================================ --}}

    {{-- Global CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- Page CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    @stack('styles')


</head>


<body>


    {{-- ===============================
    NAVBAR
    ================================ --}}

    @include('layouts.navbar')



    {{-- ===============================
    CONTENT
    ================================ --}}

    <main>

        @yield('content')

    </main>


    @extends('layouts.footer')
    {{-- ===============================
    JAVASCRIPT
    ================================ --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    @stack('scripts')


</body>

</html>