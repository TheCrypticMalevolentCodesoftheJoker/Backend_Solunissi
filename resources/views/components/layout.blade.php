<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Mi App' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header class="app-header">
        <a href="/" class="nav-link">Dashboard</a>
    </header>

    <section class="content-wrapper">
        <section class="sub-menu">
            <a href="#" class="sub-menu-link">APIs - Autenticación</a>
            <a href="#" class="sub-menu-link">APIs - Roles</a>
            <a href="/user" class="sub-menu-link">APIs - Usuarios</a>
        </section>
        <main class="app-main">
            {{ $slot }}
        </main>
    </section>

</body>

</html>