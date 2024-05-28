<!DOCTYPE html>
<html lang="en">
    <head>
        <?php vel_set_social_meta() ?>
        <?php vel_set_page_meta() ?>

        <link rel="stylesheet" href="/css/toastr.css">
        <link rel="stylesheet" href="/css/core.css">
        <link rel="stylesheet" href="/css/account.css">
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="/js/toastr.js"></script>

        <script>
            toastr.options = {
                "positionClass": "toast-top-right",
                "timeOut": "5000",
                "extendedTimeOut": "5000",
                "preventDuplicates": true,
                "toastrTextFontFamily": "Poppins",
                "progressBar": true,
            };
        </script>


        

        

        <?php echo $__env->yieldContent('head'); ?>

    </head>
    <body class="show-nav-<?php echo $__env->yieldContent('show-nav', 'true'); ?>">
        <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>

        <div class="vel-toast">
            <script>
                <?php echo !empty(session()->get('success')) ? 'toastr.success("'.session()->get('success').'");' : ''; ?>

                <?php echo !empty(session()->get('info')) ? 'toastr.info("'.session()->get('info').'");' : ''; ?>

                <?php echo !empty(session()->get('warning')) ? 'toastr.warning("'.session()->get('warning').'");' : ''; ?>

                <?php echo !empty(session()->get('error')) ? 'toastr.error("'.session()->get('error').'");' : ''; ?>

            </script>
        </div>


    </body>
</html>
<?php /**PATH F:\www\BE-J2-P4\resources\views/layouts/app.blade.php ENDPATH**/ ?>