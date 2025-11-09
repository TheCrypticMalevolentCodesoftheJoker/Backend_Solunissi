<x-layout :title="'Autenticacion'">
    <p class="dashboard-title">Endpoints - API RESTful de Autenticación</p>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Iniciar sesión de usuario</h1>
            <p class="card-url">http://127.0.0.1:8000/api/autenticacion/login</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    <p class="dashboard-title">Endpoints - API RESTful de Usuarios</p>
    <a class="card-link-wrapper" href="{{ url('api/autenticacion') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los usuarios</h1>
            <p class="card-url">http://127.0.0.1:8000/api/autenticacion</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Crea un nuevo usuario</h1>
            <p class="card-url">http://127.0.0.1:8000/api/autenticacion</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="{{ url('api/autenticacion/1') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Detalle de un usuario</h1>
            <p class="card-url">http://127.0.0.1:8000/api/autenticacion/{id}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">PUT - Actualizar usuario</h1>
            <p class="card-url">http://127.0.0.1:8000/api/autenticacion/{id}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">DELETE - Eliminar usuario</h1>
            <p class="card-url">http://127.0.0.1:8000/api/autenticacion/{id}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
</x-layout>