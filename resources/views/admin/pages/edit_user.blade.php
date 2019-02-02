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
                            <li class="breadcrumb-item active"><a href="{!!url('/admin/view-users')!!}">Danh Sách Thành
                                    Viên</a></li>
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
                                       class="form-control"
                                       value="{!! old('name', isset($user) ? $user->name : none) !!}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input id="email" name="email" readonly type="email" placeholder="Nhập email" required
                                       class="form-control"
                                       value="{!! old('email', isset($user) ? $user->email : none) !!}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="roles">Chức danh: </label>
                                @foreach($roles as $role)
                                    <div class="form-check ml-3 mb-3">
                                        <input
                                                @if($rolesOfUser->contains($role->id))
                                                        {{"checked"}}
                                                @endif
                                                type="checkbox" value="{{$role->id}}" name="roles[]"
                                                class="form-check-input" id="{{$role->id}}">
                                        <label class="form-check-label"
                                               for="{{$role->id}}">{{$role->display_name}}</label>
                                    </div>
                                @endforeach
                            </div>
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

@endsection