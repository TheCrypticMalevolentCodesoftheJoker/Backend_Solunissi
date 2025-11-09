<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => 'Contabilidad']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Contabilidad')]); ?>
    <p class="dashboard-title">Endpoints - API RESTful de Catalogos</p>

    
    <a class="card-link-wrapper" href="<?php echo e(url('api/contabilidad/centros-costo')); ?>">
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

    
    <a class="card-link-wrapper" href="<?php echo e(url('api/contabilidad/tipos-transaccion')); ?>">
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

    
    <a class="card-link-wrapper" href="<?php echo e(url('api/contabilidad/cuentas-contables')); ?>">
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH F:\Dev\Backend_Solunissi\resources\views/contabilidad.blade.php ENDPATH**/ ?>