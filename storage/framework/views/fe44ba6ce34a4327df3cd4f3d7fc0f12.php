<!-- Page head -->
<?php $__env->startSection('head'); ?>

<title>Home || <?php echo e(env('APP_NAME')); ?></title>

<?php $__env->stopSection(); ?>

<!-- Page content -->
<?php $__env->startSection('content'); ?>

<main>
    <section class="block block--header block--header-home">
        <div class="container">
            <div class="text">
                <h1><?php echo e(env('APP_NAME')); ?></h1>
            </div>
        </div>
    </section>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\www\BE-J2-P4\resources\views/pages/home.blade.php ENDPATH**/ ?>