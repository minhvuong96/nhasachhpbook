@extends('hpbook.master')
@section('title')
Đơn Hàng Của Tôi - HPBOOK
@endsection
@section('css')
		<!-- style page cart -->
	<link rel="stylesheet" href="hpbook/css/style-my-order.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item breadcrumbText text-capitalize">Tài Khoản</li>
				    <li class="breadcrumb-item active breadcrumbText text-capitalize bcActive" aria-current="page">Đơn Hàng Của Tôi</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
		<div class="container">
			@foreach($transaction as $item)
            <!-- 1 đơn hàng -->
			<div class="oneOrder">
                <div class="col-12">
                    <div class="topOrder clearfix">
                        <div class="float-left">
                            <h4>Đơn hàng <a href="javascript:void(0)">#{!!$item->id!!}</a></h4>
                            <div>Đặt ngày @php
							$dateOrder = date("d/m/Y H:i:s",strtotime($item->created_at));
							echo $dateOrder;
						@endphp</div>
                        </div>
                        @if($item->status<5)
                        <a href="{!!url('/chi-tiet-don-hang',$item->id)!!}" class="float-right manageOrder">QUẢN LÝ</a>
                        @endif
                    </div>
                    @foreach($item->products as $product)
                    <div class="row contentOrder">
                        <div class="col-sm-5 productOrder">
                            <a href="{!!url('/chi-tiet',$product->alias)!!}" class="float-left mr-2"><img src="admin_public/upload/products/{!!$product->image!!}" alt="{!!$product->alias!!}"></a>
                            <span class="productName">{!!$product->name!!}</span>
                            
                        </div>
                        @php
                        	$quantity = DB::table('product_transaction')->where('transaction_id',$item->id)->where('product_id',$product->id)->first()->quantity;
                        @endphp
                        <div class="col-sm-2 mt-3 mt-sm-0">
                            <span class="quantity">Qty: <b>{!!$quantity!!}</b></span>
                        </div>
                        <div class="col-sm-5 productStatus clearfix">
                        	@switch($item->status)
							    @case(1)
							        <div class="mt-2 mt-sm-0 float-sm-left statusOrder">Chờ xử lý</div>
							        @break

							    @case(2)
							        <div class="mt-2 mt-sm-0 float-sm-left statusOrder">Đã tiếp nhận</div>
							        @break
								@case(3)
									<div class="mt-2 mt-sm-0 float-sm-left statusOrder">Đang giao hàng</div>
									@break
								@case(4)
									<div class="mt-2 mt-sm-0 float-sm-left statusOrder">Đã giao hàng</div>
									@break
							    @default
							        <div class="mt-2 mt-sm-0 float-sm-left statusOrder">Đã hủy đơn</div>
							@endswitch
                			@if($item->status==4)
                            <div class="mt-2 mt-sm-0 float-sm-right time">Đã giao ngày @php
							$dateOrder = date("d/m/Y H:i:s",strtotime($item->updated_at));
							echo $dateOrder;
						@endphp</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!--end 1 đơn hàng -->
            @endforeach
		</div>
		<!-- end container -->
	</div>
	<!-- end content -->
@endsection