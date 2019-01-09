<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <base href="{!!asset('')!!}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="hpbook/images/39c70677-cb25-4c54-9951-25862ec1756a.png">
        
        @yield('css')
        <!-- App css -->
        <link href="admin_public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="admin_public/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="admin_public/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="fontawesome-free-5.3.1-web/css/all.css">
        <link href="admin_public/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="admin_public/js/modernizr.min.js"></script>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            @include('admin.blocks.topbar')
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.blocks.leftmenu')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                @yield('content')

                <footer class="footer text-right">
                    2018 © HPBOOK - Nhà sách số 1 Hải Phòng
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
       
        
        <script src="admin_public/js/jquery.min.js"></script>
        <script src="admin_public/js/popper.min.js"></script>
        <script src="admin_public/js/bootstrap.min.js"></script>
        <script src="admin_public/js/metisMenu.min.js"></script>
        <script src="admin_public/js/waves.js"></script>
        <script src="admin_public/js/jquery.slimscroll.js"></script>
        <script src="admin_public/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="admin_public/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Chart JS -->
        <script src="admin_public/plugins/chart.js/chart.bundle.js"></script>
    
        <!-- init dashboard -->
        

        <!-- App js -->
        <script src="admin_public/js/jquery.core.js"></script>
        <script src="admin_public/js/jquery.app.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        @yield('script')
    </body>
</html>