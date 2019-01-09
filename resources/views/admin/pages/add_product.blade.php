@extends('admin.master')
@section('title')
Thêm Sách - HPBOOK ADMIN
@endsection

@section('content')
	<div class="content">
	<div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Quản Lý Kho</li>
                                        <li class="breadcrumb-item active">Thêm Sách</li>
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
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Thêm Sách</h4>
                                    <form onsubmit="return validateForm();" action="{!!url('admin/add-product')!!}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{!!csrf_token()!!}" >
                                        <div class="form-group col-lg-6">
                                            <label for="name">Tên sách<span class="text-danger">*</span></label>
                                            <input value="{!! old('name') !!}" id="name" name="name" type="text" placeholder="Nhập tên sản phẩm" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="price">Giá <span class="text-danger">*</span></label>
                                            <input value="{!! old('price') !!}" id="price" name="price" type="number" placeholder="Nhập giá" required
                                                   class="form-control w-50 " step="1000" min="0">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="discount">Phần trăm giảm giá<span class="text-danger">*</span></label>
                                            <input value="{!! old('discount') !!}" id="discount" name="discount" type="number"  required
                                                   class="form-control w-50 d-inline"  min="0" max="99" ><span> %</span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="description">Mô tả<span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" class="form-control">{!! old('description') !!}</textarea>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="count_buy">Số lượt mua <span class="text-danger">*</span></label>
                                            <input value="{!! old('count_buy') !!}" id="count_buy" name="count_buy" type="number"  required
                                                   class="form-control w-50 " min="0">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="quantity">Số lượng sách <span class="text-danger">*</span></label>
                                            <input value="{!! old('quantity') !!}" id="quantity" name="quantity" type="number"  required
                                                   class="form-control w-50 " min="0">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="rating">Điểm đánh giá <span class="text-danger">*</span></label>
                                            <input value="{!! old('rating') !!}" id="rating" name="rating" type="number"  required
                                                   class="form-control w-50 " step="0.01" min="0">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="publish_year">Năm xuất bản <span class="text-danger">*</span></label>
                                            <input value="{!! old('publish_year') !!}" id="publish_year" name="publish_year" type="number" min="1900" max="2099" required
                                                   class="form-control w-50 ">
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                                <label for="image">Ảnh đại diện<span class="text-danger">*</span></label>
                                                <input id="image" name="image" type="file" 
                                                       class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                                <label for="author">Tác giả <span class="text-danger">*</span></label>
                                                <div style="height:100px; overflow-y:scroll;">
                                                    @php
                                                        author($author,0);
                                                    @endphp
                                                </div>
                                                <p class="text-danger small mt-2" id="notifiAuthor"></p>
                                            </div>
                                        <div class="form-group col-lg-6">
                                            <label >Thuộc về danh mục</label>
                                            <select name="cate" id="cate" class="form-control">
                                            	<option value="">--Chọn danh mục--</option>
                                            	@php
                                            		cate_parent($cate);
                                            	@endphp
                                            </select>
                                            <p class="text-danger small mt-2" id="notifiCate"></p>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label >Nhà xuất bản</label>
                                            <select name="publisher" id="publisher" class="form-control">
                                            	<option value="">--Chọn nhà xuất bản--</option>
                                            	@php
                                            		publisher($publisher);
                                            	@endphp
                                            </select>
                                            <p class="text-danger small mt-2" id="notifiPublisher"></p>
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
        <script>
            function validateForm() {
                var cate = $('#cate').val();
                var publisher = $('#publisher').val();
                if (($("input[name*='author']:checked").length)<=0) {
                    $('#notifiAuthor').text("Không được bỏ trống");
                    return false;
                }
                else{
                    $('#notifiAuthor').text("");
                    if(cate == ""){
                        $('#notifiCate').text("Không được bỏ trống");
                        return false;
                    }else{
                        $('#notifiCate').text("");
                        if(publisher ==""){
                            $('#notifiPublisher').text("Không được bỏ trống");
                            return false;
                        }else{
                            return true;
                        }
                        
                    }
                }      
            }
            // $(document).ready(function() {
                
            // });
        </script>
@endsection