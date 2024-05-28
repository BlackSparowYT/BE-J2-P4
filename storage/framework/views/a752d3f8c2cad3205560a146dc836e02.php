<?php $__env->startSection('show-nav', 'false'); ?>

<!-- Page head -->
<?php $__env->startSection('head'); ?>

<title>Login || <?php echo e(env('APP_NAME')); ?></title>

<?php $__env->stopSection(); ?>

<!-- Page content -->
<?php $__env->startSection('content'); ?>

<main class="login-page page--form">
    <div class="content">
        <a href="<?php echo e(route('home')); ?>">
            <div class="image-block">
                <img src="/images/logos/logo.svg"/>
            </div>
        </a>
        <div class="form">
            <form method="post" action="<?php echo e(route('login.post')); ?>">
                <?php echo csrf_field(); ?>
                <h2>Login</h2>
                <div class="link">
                    <hr>
                    <h5>
                        LOGIN WITH EMAIL
                    </h5>
                    <hr>
                </div>
                <div>
                    <h4>Email</h4>
                    <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required>
                </div>
                <div class="passBox">
                    <h4>Password <?php if(env('SETTING_CAN_RESET_PASSWORD')): ?>  <?php endif; ?></h4>
                    <input type="password" name="password" class="password" required>
                    <a class="showPass" onclick="showPass()"><i class="showPassBtn da-icon da-icon--eye"></i></a>
                </div>
                <div class="link">
                    <button class="btn btn--primary" type="submit" name="login">Login</button>
                </div>
                <?php if(env('SETTING_CAN_REGISTER')): ?>
                    <div class="link">
                        <hr>
                        <h5>
                            <a href="<?php echo e(route('register')); ?>">REGISTER</a>
                        </h5>
                        <hr>
                    </div>
                <?php endif; ?>
            </form>
            <script>
                function showPass() {
                    const passwords = document.querySelectorAll(".passBox");
                    passwords.forEach(password => {
                        var myPass = password.querySelector(".password");
                        var showPass = password.querySelector(".showPass");
                        var showPassBtn = password.querySelector(".showPassBtn");
                        if (myPass.type === "password") {
                            myPass.type = "text";
                            showPassBtn.classList.remove("da-icon--eye");
                            showPassBtn.classList.add("da-icon--eye-slash");
                        } else {
                            myPass.type = "password";
                            showPassBtn.classList.add("da-icon--eye");
                            showPassBtn.classList.remove("da-icon--eye-slash");
                        }
                    });
                }
            </script>

        </div>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\www\BE-J2-P4\resources\views/pages/auth/login.blade.php ENDPATH**/ ?>