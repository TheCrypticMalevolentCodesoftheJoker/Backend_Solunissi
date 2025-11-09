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
            <h1 class="card-title">GET - Consultar equipos operativos</h1>
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
            <h1 class="card-title">POST - Asignar equipo operativo</h1>
            <p class="card-url">{{ url('api/rrhh/equipos-operativos/asignar') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    <p class="dashboard-title">Endpoints - API RESTful de Asistencias</p>
    <a class="card-link-wrapper" href="{{ url('api/rrhh/asistencia') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Consultar asistencia</h1>
            <p class="card-url">{{ url('api/rrhh/asistencia') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Registrar asistencia</h1>
            <p class="card-url">{{ url('api/rrhh/asistencia') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    <p class="dashboard-title">Endpoints - API RESTful de Nómina</p>
    <a class="card-link-wrapper" href="{{ url('api/rrhh/nomina') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Consultar nóminas</h1>
            <p class="card-url">{{ url('api/rrhh/nomina') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Registrar nómina</h1>
            <p class="card-url">{{ url('api/rrhh/nomina') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    <a class="card-link-wrapper" href="{{ url('api/rrhh/nomina/1/reporte') }}" target="_blank">
        <section class="card-info">
            <h1 class="card-title">GET - Reporte PDF</h1>
            <p class="card-url">{{ url('api/rrhh/nomina/1/reporte') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>



    <p class="dashboard-title">Endpoints - API RESTful de Boleta de Pago</p>
    <a class="card-link-wrapper" href="{{ url('api/rrhh/boleta-pago') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Consultar boletas de pago</h1>
            <p class="card-url">{{ url('api/rrhh/boleta-pago') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <a class="card-link-wrapper" href="#">
        <section class="card-info">
            <h1 class="card-title">POST - Registrar boleta de pago</h1>
            <p class="card-url">{{ url('api/rrhh//boleta-pago') }}</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

</x-layout>