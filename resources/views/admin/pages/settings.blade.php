@extends('admin.master')
@section('title')
Cài Đặt - HPBOOK ADMIN
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Cài Đặt</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                	@include('admin.blocks.message')
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Đổi mật khẩu</h4>
                                    <form action="{!!url('admin/update-pwd')!!}" method="post">
                                    	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                        <div class="form-group col-lg-6">
                                            <label for="current_pwd">Mật khẩu hiện tại<span class="text-danger">*</span></label>
                                            <input type="password" name="current_pwd" parsley-trigger="change" required
                                                   placeholder="Nhập mật khẩu hiện tại" class="form-control" id="current_pwd">
                                            <span id="checkPass"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="new_pwd">Mật khẩu mới<span class="text-danger">*</span></label>
                                            <input id="new_pwd" name="new_pwd" type="password" placeholder="Nhập mật khẩu mới" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="confirm_pwd">Xác nhận mật khẩu<span class="text-danger">*</span></label>
                                            <input data-parsley-equalto="#new_pwd" type="password" required
                                                   placeholder="Xác nhận lại mật khẩu" class="form-control" id="confirm_pwd">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <button class="btn btn-gradient waves-effect waves-light" type="submit">
                                                Đổi mật khẩu
                                            </button>
                                        </div>

                                    </form>
                                </div> <!-- end card-box -->
                            </div>
                            <!-- end col -->

                      
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->
    </div>
@endsection
@section('script')
	<script type="text/javascript" src="admin_public/plugins/parsleyjs/parsley.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>
@endsection