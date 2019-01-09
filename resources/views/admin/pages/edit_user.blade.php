@extends('admin.master')
@section('title')
Sửa Thành Viên - HPBOOK ADMIN
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Thành Viên</li>
                                        <li class="breadcrumb-item active"><a href="{!!url('/admin/view-users')!!}">Danh Sách Thành Viên</a></li>
                                        <li class="breadcrumb-item active">Sửa Thành Viên</li>
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
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Sửa Thành Viên</h4>
                                    <form action="" method="post">
                                    	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                        <div class="form-group col-lg-6">
                                            <label for="name">Tên<span class="text-danger">*</span></label>
                                            <input id="name" name="name" type="text" placeholder="Nhập tên" required
                                                   class="form-control" value="{!! old('name', isset($user) ? $user->name : none) !!}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input id="email" name="email" type="email" placeholder="Nhập email" required
                                                   class="form-control" value="{!! old('email', isset($user) ? $user->email : none) !!}">
                                        </div>
                                        {{-- <div class="form-group col-lg-6">
                                            <label for="password">Mật khẩu<span class="text-danger">*</span></label>
                                            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" required
                                                   class="form-control" value="{!! old('password', isset($user) ? $user->password : none) !!}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="confirm_pwd">Xác nhận mật khẩu<span class="text-danger">*</span></label>
                                            <input data-parsley-equalto="#password" type="password" required
                                                   placeholder="Xác nhận lại mật khẩu" class="form-control" id="confirm_pwd" value="{!! old('password', isset($user) ? $user->password : none) !!}>
                                        </div> --}}
                                        @if( (Auth::user()->admin)==1 && (Auth::user()->id)==3 )
                                            <div class="form-group col-lg-6">
                                                @if($user->admin ==1)
                                                <input type="checkbox" name="admin" id="admin" value="1" checked="checked"> Admin
                                                @else
                                                <input type="checkbox" name="admin" id="admin" value="1"> Admin
                                                @endif
                                            </div>
                                        @endif
                                        <div class="form-group col-lg-6">
                                            <button class="btn btn-gradient waves-effect waves-light" type="submit">
                                                Lưu
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