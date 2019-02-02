@extends('admin.master')
@section('title')
    Thêm Chức Danh - HPBOOK ADMIN
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="{!!url('/admin/view-roles')!!}">Danh Sách Chức Danh</a>
                            </li>
                            <li class="breadcrumb-item active">Thêm Chức Danh</li>
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
                        <h4 class="header-title m-t-0 mb-4 mt-4">Thêm Chức Danh</h4>
                        <form action="{!!url('admin/add-role')!!}" method="post">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <div class="form-group col-lg-6">
                                <label for="name">Định Danh<span class="text-danger">*</span></label>
                                <input id="name" name="name" type="text" placeholder="VD: admin" required
                                       class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="display_name">Tên Hiển Thị<span class="text-danger">*</span></label>
                                <input id="display_name" name="display_name" type="text" placeholder="VD: Admin"
                                       required
                                       class="form-control">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="description">Mô tả<span class="text-danger">*</span></label>
                                <input id="description" name="description" type="text" placeholder="VD: Admin"
                                       class="form-control">
                            </div>
                            <div class="form-group col-lg-6 mb-0">
                                <label>Danh sách quyền: </label>
                            </div>
                            @foreach($permissions as $permission)
                                <div class="form-check ml-3 mb-3">
                                    <input type="checkbox" value="{{$permission->id}}" name="permissions[]" class="form-check-input" id="{{$permission->id}}">
                                    <label class="form-check-label" for="{{$permission->id}}">{{$permission->display_name}}</label>
                                </div>
                            @endforeach
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
    <script type="text/javascript" src="admin_public/plugins/parsleyjs/parsley.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('form').parsley();
        });
    </script>
@endsection