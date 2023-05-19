<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Ideal Hostel
    </title>

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Dropdown Menu -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/superfish.css">
    <!-- Owl Slider -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/owl.theme.default.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/bootstrap-datepicker.min.css">
    <!-- CS Select -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/cs-select.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/cs-skin-border.css">

    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/themify-icons.css">
    <!-- Flat Icon -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/flaticon.css">
    <!-- Icomoon -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/icomoon.css">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/flexslider.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/landing_page/css/style.css">
    <!-- CSS Files -->
    <link href="{{ asset('assets') }}/css/styles.css" rel="stylesheet">


    <!-- Modernizr JS -->
    <script src="{{ asset('assets') }}/landing_page/js/modernizr-2.6.2.min.js"></script>

</head>

<body>
    <div id="fh5co-wrapper">
        <div id="fh5co-page">

            @yield('content')

        </div>
        <!-- END fh5co-page -->

    </div>
    <!-- END fh5co-wrapper -->

    <!-- Javascripts -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery-2.1.4.min.js"></script>
    <!-- Dropdown Menu -->
    <script src="{{ asset('assets') }}/landing_page/js/hoverIntent.js"></script>
    <script src="{{ asset('assets') }}/landing_page/js/superfish.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets') }}/landing_page/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.waypoints.min.js"></script>
    <!-- Counters -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.countTo.js"></script>
    <!-- Stellar Parallax -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.stellar.min.js"></script>
    <!-- Owl Slider -->
    <!-- // <script src="{{ asset('assets') }}/landing_page/js/owl.carousel.min.js"></script> -->
    <!-- Date Picker -->
    <script src="{{ asset('assets') }}/landing_page/js/bootstrap-datepicker.min.js"></script>
    <!-- CS Select -->
    <script src="{{ asset('assets') }}/landing_page/js/classie.js"></script>
    <script src="{{ asset('assets') }}/landing_page/js/selectFx.js"></script>
    <!-- Flexslider -->
    <script src="{{ asset('assets') }}/landing_page/js/jquery.flexslider-min.js"></script>

    <script src="{{ asset('assets') }}/landing_page/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // get the toast element by its id
        const toast = document.querySelector('#successToast');

        // hide the toast after 5 seconds (5000 milliseconds)
        setTimeout(() => {
            toast.classList.remove('show');
        }, 5000);
    </script>

</body>

</html>
