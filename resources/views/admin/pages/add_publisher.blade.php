@extends('admin.master')
@section('title')
Thêm Nhà Xuất Bản - HPBOOK ADMIN
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Nhà Xuất Bản</li>
                                        <li class="breadcrumb-item active">Thêm Nhà Xuất Bản</li>
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
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Thêm Nhà Xuất Bản</h4>
                                    <form action="{!!url('admin/add-publisher')!!}" method="post">
                                    	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                        <div class="form-group col-lg-6">
                                            <label for="name">Tên nhà xuất bản<span class="text-danger">*</span></label>
                                            <input id="name" name="name" type="text" placeholder="Nhập tên nhà xuất bản" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input id="email" name="email" type="email" placeholder="Nhập email nhà xuất bản" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="address">Địa chỉ nhà xuất bản<span class="text-danger">*</span></label>
                                            <input id="address" name="address" type="text" placeholder="Nhập địa chỉ nhà xuất bản" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="description">Mô tả<span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
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
	{{-- <script type="text/javascript" src="admin_public/plugins/parsleyjs/parsley.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('form').parsley();
            });
        </script> --}}
        <script src="admin_public/ckeditor/ckeditor.js"></script>
        <script>CKEDITOR.replace( 'description', {
            filebrowserBrowseUrl: 'admin_public/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: 'admin_public/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl: 'admin_public/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl: 'admin_public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: 'admin_public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'admin_public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        } );</script>
@endsection