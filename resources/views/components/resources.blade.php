<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="\resources\js\jquery-3.7.1.min.js"></script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

