<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Đăng Nhập - HPBOOK ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{!!asset('admin_public/images/favicon.ico')!!}">

        <!-- App css -->
        <link href="{!!asset('admin_public/css/bootstrap.min.css')!!}" rel="stylesheet" type="text/css" />
        <link href="{!!asset('admin_public/css/icons.css')!!}" rel="stylesheet" type="text/css" />
        <link href="{!!asset('admin_public/css/metismenu.min.css')!!}" rel="stylesheet" type="text/css" />
        <link href="{!!asset('admin_public/css/style.css')!!}" rel="stylesheet" type="text/css" />

        <script src="{!!asset('admin_public/js/modernizr.min.js')!!}"></script>

    </head>


    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <span>HPBOOK</span>
                                            </a>
                                        </h2>
                                        <h6 class="text-uppercase text-center font-bold mt-4">Đăng Nhập</h6>
                                        @include('admin.blocks.message')
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" action="{!!url('/admin')!!}" method="post">
                                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <label for="emailaddress">Email</label>
                                                    <input class="form-control" type="email" id="emailaddress" name="email" required="" placeholder="Nhập email của bạn">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    {{-- <a href="page-recoverpw.html" class="text-muted pull-right"><small>Quên mật khẩu?</small></a> --}}
                                                    <label for="password">Mật Khẩu</label>
                                                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Nhập mật khẩu">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">


                                                </div>
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-block btn-gradient waves-effect waves-light" type="submit">Đăng Nhập</button>
                                                </div>
                                            </div>

                                        </form>

                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->


        <!-- jQuery  -->
        <script src="{!!asset('admin_public/js/jquery.min.js')!!}"></script>
        <script src="{!!asset('admin_public/js/popper.min.js')!!}"></script>
        <script src="{!!asset('admin_public/js/bootstrap.min.js')!!}"></script>
        <script src="{!!asset('admin_public/js/metisMenu.min.js')!!}"></script>
        <script src="{!!asset('admin_public/js/waves.js')!!}"></script>
        <script src="{!!asset('admin_public/js/jquery.slimscroll.js')!!}"></script>

        <!-- App js -->
        <script src="{!!asset('admin_public/js/jquery.core.js')!!}"></script>
        <script src="{!!asset('admin_public/js/jquery.app.js')!!}"></script>

    </body>
</html>