@extends('hpbook.master')
@section('title')
Xác Nhận Hủy - HPBOOK
@endsection
@section('css')
		<!-- style page cart -->
	<link rel="stylesheet" href="hpbook/css/style-confirm-cancellation.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/don-hang-cua-toi')!!}">Đơn Hàng Của Tôi</a></li>
				    <li class="breadcrumb-item active breadcrumbText text-capitalize bcActive" aria-current="page">Xác Nhận Hủy</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
		<div class="container">
            <div class="wrapper">
                    <h4 class="title text-success text-center"><i class="fas fa-check-circle"></i> Hủy đơn hàng thành công</h4>
            </div>
            <div class="wrapper mt-2">
                    <div class="text-center label">Sản phẩm đã bị hủy</div>
                    <div class="row contentOrder mt-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                        @foreach($transaction->products as $product)
                            <div class="row mt-3">
                                    <div class="col-sm-6 productOrder">
                                            <a href="{!!url('/chi-tiet',$product->alias)!!}" class="float-left mr-2"><img src="admin_public/upload/products/{!!$product->image!!}" alt="{!!$product->alias!!}"></a>
                                            <span class="productName">{!!$product->name!!}</span>
                                            
                                        </div>
                                        <div class="col-sm-4 mt-3 mt-sm-0">
                                                <span class="priceUnit">{!!number_format($product->price-$product->price*$product->discount/100,0,',','.')!!} đ</span>
                                        </div>
                                        @php
                                            $quantity = DB::table('product_transaction')->where('transaction_id',$transaction->id)->where('product_id',$product->id)->first()->quantity;
                                        @endphp
                                        <div class="col-sm-2 productStatus">
                                            <span class="quantity">Qty: <b>{!!$quantity!!}</b></span>
                                        </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="col-sm-2"></div>        
                    </div> 
                    <!-- end contentOrder -->
                    <div class="text-center order mt-4">Để đặt hàng lại các sản phẩm đã hủy vui lòng chọn <a href="">ĐẶT HÀNG LẠI</a></div>
            </div>
		</div>
	</div>
	<!-- end content -->
@endsection