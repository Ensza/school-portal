<meta name="viewport" content="width=device-width, initial-scale=1">
<!--
<script src="\resources\bootstrap-5.3.2-dist\js\bootstrap.min.js"></script>
<link rel="stylesheet" href="\resources\bootstrap-5.3.2-dist\css\bootstrap.min.css">
-->
<script src="\resources\js\jquery-3.7.1.min.js"></script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<!--@<script src="{\{ asset('vendor/datatables/buttons.server-side.js') }}"></script>-->
