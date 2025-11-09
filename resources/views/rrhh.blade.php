<x-layout :title="'RRHH'">
    <p class="dashboard-title">Endpoints - API RESTful de Cargos</p>

    <a class="card-link-wrapper" href="{{ url('api/rrhh/cargos') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los cargos</h1>
            <p class="card-url">{{ url('api/rrhh/cargos') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <p class="dashboard-title">Endpoints - API RESTful de Empleados</p>

    <a class="card-link-wrapper" href="{{ url('api/rrhh/empleados') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los empleados</h1>
            <p class="card-url">{{ url('api/rrhh/empleados') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Registrar un nuevo empleado</h1>
            <p class="card-url">{{ url('api/rrhh/empleados') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <p class="dashboard-title">Endpoints - API RESTful de Equipos Operativos</p>
    <a class="card-link-wrapper" href="{{ url('api/rrhh/equipos-operativos') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los equipos operativos</h1>
            <p class="card-url">{{ url('api/rrhh/equipos-operativos') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Crear equipo operativo y asignar empleados</h1>
            <p class="card-url">{{ url('api/rrhh/equipos-operativos/asignar') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
</x-layout>