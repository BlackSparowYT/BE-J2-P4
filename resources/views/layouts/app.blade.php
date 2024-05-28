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


        {{--
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        --}}

        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-YBKBS0EKY7"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-YBKBS0EKY7');
        </script> --}}

        @yield('head')

    </head>
    <body class="show-nav-@yield('show-nav', 'true')">
        @include('components.navbar')
        @yield('content')

        <div class="vlx-toast">
            <script>
                {!! !empty(session()->get('success')) ? 'toastr.success("'.session()->get('success').'");' : '' !!}
                {!! !empty(session()->get('info')) ? 'toastr.info("'.session()->get('info').'");' : '' !!}
                {!! !empty(session()->get('warning')) ? 'toastr.warning("'.session()->get('warning').'");' : '' !!}
                {!! !empty(session()->get('error')) ? 'toastr.error("'.session()->get('error').'");' : '' !!}
            </script>
        </div>


    </body>
</html>
