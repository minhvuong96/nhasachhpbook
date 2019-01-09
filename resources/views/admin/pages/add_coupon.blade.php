@extends('admin.master')
@section('title')
Thêm Mã Giảm Giá - HPBOOK ADMIN
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item active">Mã Giảm Giá</li>
                                        <li class="breadcrumb-item active">Thêm Mã</li>
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
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Thêm Mã</h4>
                                    <form action="{!!url('admin/add-coupon')!!}" method="post">
                                    	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                        <div class="form-group col-lg-3">
                                            <label for="name">Mã: <span class="text-danger">*</span></label>
                                            <input id="code" value="{!! old('code') !!}" name="code" type="text" placeholder="Nhập mã giảm giá" required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="discount">Giảm giá: <span class="text-danger">*</span></label>
                                            <input value="{!! old('discount') !!}" id="discount" name="discount" type="number"  required
                                                   class="form-control w-25 d-inline"  min="0" max="99" ><span> %</span>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="name">Ngày hết hạn: <span class="text-danger">*</span></label>
                                            <input id="datepicker" name="expiry_date" type="text"required
                                                   class="form-control">
                                        </div>
                                        <div class="form-group form-check col-lg-6 ml-3">
                                            <input name="status" type="checkbox" value="1" class="form-check-input" id="status">
                                            <label class="form-check-label" for="status">Kích hoạt</label>
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
          <script>
          $( function() {
            $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
          } );
          //$.datepicker.formatDate( "dd-mm-yy");
          </script>

@endsection