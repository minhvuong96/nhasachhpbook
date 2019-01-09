@extends('admin.master')
@section('title')
Chi Tiết Đơn Hàng - HPBOOK ADMIN
@endsection
@section('css')
    <link rel="stylesheet" href="admin_public/css/style-edit-new-order.css">
@endsection
@section('content')
	<div class="content">
	<div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb float-left">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        @if($transaction->status==1 && $transaction->payment==3)
                                        <li class="breadcrumb-item">Đơn Hàng Trả Sau</li>
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/new-order-cod')!!}">Đơn Hàng Mới</a></li>
                                        @elseif($transaction->status==1 && $transaction->payment!=3)
                                        <li class="breadcrumb-item">Đơn Hàng Trả Trước</li>
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/new-order')!!}">Đơn Hàng Mới</a></li>
                                        @elseif($transaction->status!=1 && $transaction->payment==3)
                                        <li class="breadcrumb-item">Đơn Hàng Trả Sau</li>
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/view-order-cod')!!}">Danh Sách Đơn</a></li>
                                        @else
                                        <li class="breadcrumb-item">Đơn Hàng Trả Trước</li>
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/view-order')!!}">Danh Sách Đơn</a></li>
                                        @endif
                                        <li class="breadcrumb-item active">Chi Tiết Đơn Hàng</li>
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
                                    <h4 class="header-title m-t-0 mb-4 mt-4">Chi Tiết Đơn Hàng</h4>
                                    <form action="{!!url('admin/edit-order')!!}" method="post" id="main-form">
                                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        
                                            
                                            <input type="hidden" name="transaction_id" value="{!!$transaction->id!!}">
                                            <div class="form-group col-lg-9 wrapper detailOrder">
                                                
                                                <div class="form-group title">Đơn hàng #{!!$transaction->id!!}</div>
                                                <a href="{!!url('/admin/invoice',$transaction->id)!!}" class="float-right btn btn-info btn-sm text-uppercase">in hóa đơn</a>
                                                <div class="form-group timeOrder mt-1">Đặt ngày @php
                                                        $dateOrder = date("d/m/Y H:i:s",strtotime($transaction->created_at));
                                                        echo $dateOrder;
                                                    @endphp</div>
                                                <div class="status form-group">Trạng thái: 
                                                    @if($transaction->status==1)
                                                    Chờ xử lý
                                                    @elseif($transaction->status==2)
                                                    Đã tiếp nhận
                                                    @elseif($transaction->status==3)
                                                    Đang giao hàng
                                                    @elseif($transaction->status==4)
                                                    Đã giao hàng
                                                    @else
                                                    Đã hủy
                                                    @endif

                                                </div>
                                                <div class="form-group">Sản Phẩm: </div>
                                                @foreach($transaction->products as $item)
                                                <div class="mt-4 mt-sm-3 oneProduct clearfix">
                                                    
                                                    <div class="col-sm-3 nameProduct float-left mr-5">{!!$item->name!!}</div>
                                                    <span class="col-sm-3 form-group priceProduct float-left mr-5 mt-3 mt-sm-0">{!!number_format($item->price-$item->price*$item->discount/100,0,',','.')!!} đ</span>
                                                    @php
                                                        $quantity = DB::table('product_transaction')->where('product_id',$item->id)->where('transaction_id',$transaction->id)->first()->quantity;
                                                    @endphp
                                                    <span class="col-sm-3 float-left mt-1 mt-sm-0">Qty:<input @if($transaction->status<>1)readonly @endif type="number"  name="quantity[]" class="quantity" value="{!!$quantity!!}" min="1" max="{!!$item->quantity+$quantity!!}">
                                                    </span>
                                                    <input  type="hidden" name="product_id[]" value="{!!$item->id!!}">
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group col-lg-9 wrapper total">
                                                <div class="form-group title">Thành tiền</div>
                                                <div class="form-group">
                                                    <label>Tạm tính: </label>
                                                    <span class="priceTemporary">{!!number_format($transaction->amount_temporary,0,',','.')!!} đ</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount_shipping">Phí vận chuyển: </label>
                                                    <input @if($transaction->status<>1)readonly @endif type="number" id="amount_shipping" name="amount_shipping" value="{!!$transaction->amount_shipping!!}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Giảm giá: </label>
                                                    <span class="amount_discount">{!!number_format($transaction->amount_discount,0,',','.')!!} đ</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount_total">Tổng cộng: </label>
                                                    <span class="amount_total"><strong>{!!number_format($transaction->amount_total)!!} đ</strong></span>

                                                </div>
                                            <div class="form-group payment">Hình thức thanh toán: <strong>
                                                @if ($transaction->paymeny==1)
                                                Sử dụng thẻ tín dụng
                                                @elseif($transaction->payment==2)
                                                Chuyển khoản
                                                @else
                                                COD
                                                @endif 
                                                </strong></div>
                                            @if($transaction->payment==2)
                                            <div class="pay_status">
                                                @if($transaction->pay_status==1)
                                                <div class="form-group label"><label for="">Thanh toán:</label>Đã thanh toán</div>
                                                @else
                                                <input class="form-check-inline" type="checkbox" name="pay_status" value="1">Đã thanh toán
                                                @endif
                                            </div>
                                            @endif
                                            @if($transaction->status==1)
                                            <button class="btn btn-success mt-3" name="btnReload" type="submit" form="main-form" value="btnReload">
                                                    Làm mới
                                            </button>
                                            @endif
                                            </div>
                                            <div class="form-group col-lg-9 wrapper infoUser">
                                                <div class="form-group title">Thông tin khách hàng</div>
                                                <div class="form-group label"><label for="">Tên:</label>{!!$transaction->user->name!!}</div>
                                                <div class="form-group label"><label for="">Email:</label>{!!$transaction->user->email!!}</div>
                                                <div class="form-group label"><label for="">Số điện thoại:</label>{!!$transaction->user->phone!!}</div>
                                                <div class="form-group label"><label for="">Địa chỉ khách hàng:</label>{!!$transaction->user->address!!}</div>
                                                <div class="label"><label for="">Địa chỉ giao hàng:</label>@if(isset($transaction->user->other_address)){!!$transaction->user->other_address!!}@else{!!$transaction->user->address!!}@endif</div>
                                                <textarea class="form-group mt-2" readonly cols="40" rows="5" placeholder="Ghi chú của khách hàng">{!!$transaction->note!!}</textarea>
                                            </div>
                                            
                                        @if($transaction->status!=5)
                                        <div class="form-group col-lg-9">
                                            @if($transaction->status<4)
                                            <button class="btn btn-gradient waves-effect waves-light" type="submit" name="btnApproval" form="main-form" value="btnApproval">
                                                @if($transaction->status==1)
                                                Duyệt Đơn Hàng
                                                @else
                                                Tiếp Theo
                                                @endif
                                            </button>
                                            <a href="{!!url('/admin/cancellation',$transaction->id)!!}" class="btn btn-danger" >
                                                Hủy Đơn Hàng
                                            </a>
                                            @endif
                                            
                                        </div>
                                        @endif
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
        {{-- <script src="admin_public/ckeditor/ckeditor.js"></script>
        <script>CKEDITOR.replace( 'description', {
            filebrowserBrowseUrl: 'admin_public/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: 'admin_public/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl: 'admin_public/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl: 'admin_public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: 'admin_public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: 'admin_public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        } );</script> --}}
@endsection