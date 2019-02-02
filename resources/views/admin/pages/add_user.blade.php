@extends('admin.master')
@section('title')
    Thêm Thành Viên - HPBOOK ADMIN
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="{!!url('/admin/view-users')!!}">Danh Sách Thành
                                    Viên</a></li>
                            <li class="breadcrumb-item active">Thêm Thành Viên</li>
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
                        <h4 class="header-title m-t-0 mb-4 mt-4">Thêm Thành Viên</h4>
                        <form action="{!!url('admin/add-user')!!}" method="post">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <div class="form-group col-lg-6">
                                <label for="name">Tên<span class="text-danger">*</span></label>
                                <input id="name" name="name" type="text" placeholder="Nhập tên" required
                                       class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input id="email" name="email" type="email" placeholder="Nhập email" required
                                       class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password">Mật khẩu<span class="text-danger">*</span></label>
                                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu"
                                       required
                                       class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="confirm_pwd">Xác nhận mật khẩu<span class="text-danger">*</span></label>
                                <input data-parsley-equalto="#password" type="password" required
                                       placeholder="Xác nhận lại mật khẩu" class="form-control" id="confirm_pwd">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="roles">Chức danh: </label>
                                @foreach($roles as $role)
                                    <div class="form-check ml-3 mb-3">
                                        <input type="checkbox" value="{{$role->id}}" name="roles[]"
                                               class="form-check-input" id="{{$role->id}}">
                                        <label class="form-check-label"
                                               for="{{$role->id}}">{{$role->display_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group col-lg-6">
                                <button class="btn btn-gradient waves-effect waves-light" type="submit">
                                    Thêm
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

    <script type="text/javascript"></script>
@endsection