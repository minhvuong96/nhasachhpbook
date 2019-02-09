@extends('hpbook.master')
@section('title')
Giỏ Hàng - HPBOOK
@endsection
@section('css')
<!-- style page cart -->
<link rel="stylesheet" href="hpbook/css/cart.css">
@endsection
@section('content')
<!-- breadcrumb -->
<div class="container">
	<div class="row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
					<li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Giỏ Hàng</li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<!-- end breadcrumb -->
<!-- content -->
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-12 cart">
				<h2>giỏ hàng</h2>
				@if(!Cart::isEmpty())
				<div class="table-responsive">
					<table>
						<tr>
							<th>Xóa</th>
							<th>Hình Ảnh</th>
							<th>Tên Sách</th>
							<th>Giá</th>
							<th>Số Lượng</th>
							<th>Thành Tiền</th>
						</tr>
						@foreach(Cart::getContent() as $item)
						@php
						$product = DB::table('products')->find($item->id);
						@endphp
						<tr id="tr{!!$item->id!!}">
							<td>
								<a href="javascript:void(0)" data-id="{!!$item->id!!}" class="mr-2 deleteUnitCart">
									<i class="fas fa-trash-alt"></i>
								</a>
								<a href="javascript:void(0)" data-id="{!!$item->id!!}" class="updateUnitCart">
									<i class="fas fa-sync-alt text-success"></i>
								</a>
							</td>
							<td>
								<a href="{!!url('/chi-tiet',$item->attributes->alias)!!}">
									<img src="admin_public/upload/products/{!!$item->attributes->image!!}" alt="{!!$item->attributes->alias!!}">
								</a>
							</td>
							<td>
								<a href="{!!url('/chi-tiet',$item->attributes->alias)!!}">{!!$item->name!!}</a>
							</td>
							<td>
								<span>{!!number_format($item->price,0,",",".")!!} đ</span>
							</td>
							<td>
								<input type="number" min="1" max="{!!$product->quantity + $item->quantity!!}" value="{!!$item->quantity!!}" name="quantityProduct" class="quantityProduct">
							</td>
							<td>
								<input type="hidden"  value="{!!$item->price!!}" id="priceProduct{!!$item->price!!}">
								<span class="unit_total{!!$item->id!!}">{!!number_format($item->price*$item->quantity,0,",",".")!!} đ</span>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
				@else
				<span class="mt-2">Giỏ hàng trống</span>
				@endif
			</div>
		</div>
		@if(!Cart::isEmpty())
		<div class="row mt-3">
			<div class="col-xl-9 col-md-7 col-lg-8 col-12">
				<a href="{!!url('/')!!}"  class="btn btn-success btnCart">tiếp tục mua</a>
			</div>
			<div class="col-xl-3 col-md-5 col-lg-4 col-12 mt-3 mt-sm-0">
				<span id="labelTotal">Tổng tiền</span>
				<span id="priceTotal">{!!number_format(Cart::getTotal(),0,",",".")!!} đ</span>
			</div>
		</div>
		<div class="row mt-md-4 mt-3 mb-md-4 mb-3">
			<div class="col-xl-8 d-md-block d-none"></div>
			<div class="col-12 col-xl-4 text-sm-right">
				<a href="{!!url('/dat-hang')!!}"  class="btn btn-success btnCart mr-3">thanh toán</a>
			</div>
		</div>
		@endif
	</div>
</div>
<!-- end content -->
@endsection
@section('script')
<script type="text/javascript" src="hpbook/js/ajaxUnitCart.js"></script>
@endsection