<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'RRHH']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('RRHH')]); ?>
    <p class="dashboard-title">Endpoints - API RESTful de Cargos</p>

    <a class="card-link-wrapper" href="<?php echo e(url('api/rrhh/cargos')); ?>">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los cargos</h1>
            <p class="card-url"><?php echo e(url('api/rrhh/cargos')); ?></p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <p class="dashboard-title">Endpoints - API RESTful de Empleados</p>

    <a class="card-link-wrapper" href="<?php echo e(url('api/rrhh/empleados')); ?>">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los empleados</h1>
            <p class="card-url"><?php echo e(url('api/rrhh/empleados')); ?></p>
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
            <p class="card-url"><?php echo e(url('api/rrhh/empleados')); ?></p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
    <p class="dashboard-title">Endpoints - API RESTful de Equipos Operativos</p>
    <a class="card-link-wrapper" href="<?php echo e(url('api/rrhh/equipos-operativos')); ?>">
        <section class="card-info">
            <h1 class="card-title">GET - Lista todos los equipos operativos</h1>
            <p class="card-url"><?php echo e(url('api/rrhh/equipos-operativos')); ?></p>
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
            <p class="card-url"><?php echo e(url('api/rrhh/equipos-operativos/asignar')); ?></p>
        </section>
        <section class="card-action">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
    </a>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH F:\Dev\Backend_Solunissi\resources\views\rrhh.blade.php ENDPATH**/ ?>