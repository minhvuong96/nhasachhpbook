@extends('admin.master')
@section('title')
Sửa Danh Mục - HPBOOK ADMIN
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Danh Mục</li>
                                        <li class="breadcrumb-item active"><a href="{!!url('/admin/view-categories')!!}">Danh Sách Danh Mục</a></li>
                                        <li class="breadcrumb-item active">Sửa Danh Mục</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Thêm Danh Mục</h4>
                                    <form action="" method="post">
                                    	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                        <div class="form-group col-lg-6">
                                            <label >Thuộc về danh mục</label>
                                            <select name="parent_id" class="form-control">
                                            	<option value="0">--Chọn danh mục--</option>
                                            	@php
								                    cate_parent($parent,0,"--",$cate['parent_id']);
								                @endphp
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="name">Tên danh mục<span class="text-danger">*</span></label>
                                            <input id="name" name="name" type="text" value="{!! old('name', isset($cate) ? $cate['name'] : null)!!}" placeholder="Nhập tên danh mục" required
                                                   class="form-control">
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
	{{-- <script type="text/javascript" src="admin_public/plugins/parsleyjs/parsley.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script> --}}
@endsection