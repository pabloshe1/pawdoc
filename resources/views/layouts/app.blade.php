<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'PawDoc') }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,700;1,400&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background-color:#1a120b;">
<div class="min-h-screen" style="background-color:#1a120b;">
@include('layouts.navigation')
@isset($header)
<header style="background-color:#1a120b;border-bottom:1px solid rgba(184,134,11,0.2);">
<div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
{{ $header }}
</div>
</header>
@endisset
<main>{{ $slot }}</main>
</div>
</body>
</html>
