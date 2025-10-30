<x-layout :title="'Usuarios'">
    <p class="dashboard-title">Endpoints - API RESTful de Usuarios</p>
    <a class="card-link-wrapper" href="{{ url('api/user') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los usuarios</h1>
            <p class="card-url">http://127.0.0.1:8000/api/user</p>
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
            <p class="card-url">http://127.0.0.1:8000/api/user</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="{{ url('api/user/1') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Detalle de un usuario</h1>
            <p class="card-url">http://127.0.0.1:8000/api/user/1</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
</x-layout>