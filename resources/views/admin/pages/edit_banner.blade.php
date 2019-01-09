@extends('admin.master')
@section('title')
Sửa Banner - HPBOOK ADMIN
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Quảng Cáo</li>
                                        <li class="breadcrumb-item active"><a href="{!!url('/admin/view-banners')!!}">Danh Sách Banner</a></li>
                                        <li class="breadcrumb-item active">Sửa Banner</li>
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
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Sửa Banner</h4>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                        <div class="form-group col-lg-6">
                                            <label for="link">Đường dẫn đến bài viết<span class="text-danger">*</span></label>
                                            <input value="{!! old('link', isset($banner) ? $banner->link : null ) !!}" id="link" name="link" type="text" placeholder="Nhập đường dẫn" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="image_current">Hình ảnh hiện tại<span class="text-danger">*</span></label>
                                            <img src="admin_public/upload/banners/{!!$banner->image!!}" alt="{!!$banner->image!!}" style="height:150px; width:250px;" name="image_current">
                                            <input type="hidden" value="{!!$banner->image!!}" name="image_current">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="image">Chọn hình ảnh khác<span class="text-danger">*</span></label>
                                            <input id="image" name="image" type="file"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label  for="position">Vị trí<span class="text-danger">*</span></label>
                                            <input value="{!! old('position', isset($banner) ? $banner->position : null ) !!}" id="position" class="w-50" name="position" type="number" min="1"  required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <button class="btn btn-gradient waves-effect waves-light" type="submit">
                                                Sửa
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