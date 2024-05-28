<?php

    $routes = [];
    $guest_routes = [];
    $auth_routes = [];

    foreach (Route::getRoutes() as $i => $item) {
        $route['name']      = $item->getName();
        $route['show_name'] = vlx_format_route_name($item->getName());
        $route['namespace'] = $item->action["namespace"] ?? "";

        if($route['namespace'] == 'navbar') {
            $routes[] = $route;
        } elseif ($route['namespace'] == 'guest_navbar') {
            $guest_routes[] = $route;
        } elseif ($route['namespace'] == 'auth_navbar') {
            $auth_routes[] = $route;
        }
    }

?>

<header>
    <nav class="container">

        <div class="navbar-desktop">
            <a class="navbar-desktop-sitename" href="<?php echo e(route('home')); ?>">
                <h2><?php echo e(vlx_get_env_string('APP_NAME')); ?></h2>
            </a>
            <div class="navbar-desktop-items">
                <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route($route['name'])); ?>"><p><?php echo e($route['show_name']); ?></p></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(auth()->guard()->check()): ?>
                    <?php $__currentLoopData = $auth_routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route($route['name'])); ?>"><p><?php echo e($route['show_name']); ?></p></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if(auth()->guard()->guest()): ?>
                    <?php $__currentLoopData = $guest_routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route($route['name'])); ?>"><p><?php echo e($route['show_name']); ?></p></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="navbar-mobile">
            <a class="navbar-mobile-sitename" href="<?php echo e(route('home')); ?>">
                <h2><?php echo e(vlx_get_env_string('APP_NAME')); ?></h2>
            </a>
            <div class="navbar-mobile-items">
                <div class="open-nav" onclick="openNav()"><i class="da-icon da-icon--bars da-icon--large"></i></div>
            </div>
            <div id="navbar-mobile-fullscreen" class="nav-overlay">
                <p href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="da-icon da-icon--xmark da-icon--xxx-large"></i></p>
                <div class="nav-overlay-content">
                    <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route($route['name'])); ?>"><p><?php echo e($route['show_name']); ?></p></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(auth()->guard()->check()): ?>
                        <?php $__currentLoopData = $auth_routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route($route['name'])); ?>"><p><?php echo e($route['show_name']); ?></p></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <?php $__currentLoopData = $guest_routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route($route['name'])); ?>"><p><?php echo e($route['show_name']); ?></p></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script>
            function openNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "100%"; }
            function closeNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "0%"; }
        </script>
    </nav>
</header>
<?php /**PATH F:\www\BE-J2-P4\resources\views/components/navbar.blade.php ENDPATH**/ ?>