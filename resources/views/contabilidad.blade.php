<x-layout :title="'Contabilidad'">
    <p class="dashboard-title">Endpoints - API RESTful de Catalogos</p>

    {{-- Centros de Costo --}}
    <a class="card-link-wrapper" href="{{ url('api/contabilidad/centros-costo') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los centros de costo</h1>
            <p class="card-url">http://127.0.0.1:8000/api/contabilidad/centros-costo</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    {{-- Tipos de Transacción Contable --}}
    <a class="card-link-wrapper" href="{{ url('api/contabilidad/tipos-transaccion') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los tipos de transacción contable</h1>
            <p class="card-url">http://127.0.0.1:8000/api/contabilidad/tipos-transaccion</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>

    {{-- Cuentas Contables --}}
    <a class="card-link-wrapper" href="{{ url('api/contabilidad/cuentas-contables') }}">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todas las cuentas contables</h1>
            <p class="card-url">http://127.0.0.1:8000/api/contabilidad/cuentas-contables</p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
</x-layout>
