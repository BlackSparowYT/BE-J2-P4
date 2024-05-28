<!DOCTYPE html>
<html lang="en">
    <head>
        <?php vel_set_social_meta() ?>
        <?php vel_set_page_meta() ?>

        <link rel="stylesheet" href="/css/core.css">
        <link rel="stylesheet" href="/css/account.css">
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>


        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-YBKBS0EKY7"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-YBKBS0EKY7');
        </script> --}}

        @yield('head')

    </head>
    <body>
        @yield('content')
    </body>
</html>
