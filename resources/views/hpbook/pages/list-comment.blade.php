@extends('hpbook.master')
@section('title')
Nhận xét của tôi - HPBOOK
@endsection
@section('css')
	<link rel="stylesheet" href="hpbook/css/style-list-comment.css">
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
				    <li class="breadcrumb-item active breadcrumbText text-capitalize bcActive" aria-current="page">Nhận Xét Của Tôi</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
		<div class="container">
			<div class="myComment">
				<div class="row">
					<h4 class="col-12 titleMyComment text-uppercase">
						Nhận xét của tôi
					</h4>
				</div>
				<!-- one comment -->
				@foreach($myComment as $item)
				<div class="row mt-4 mt-lg-5 p-3 bg-light" id="{!!$item->id!!}">
					<div class="col-lg-1 mt-2 mt-lg-0 dateComent">
						@php
							$dateComment = date("d/m/Y",strtotime($item->created_at));
							echo $dateComment;
						@endphp
					</div>
					<div class="col-lg-2 mt-2 mt-lg-0 text-capitalize bookComment">
						<a href="{!!url('/chi-tiet',$item->product->alias)!!}">{!!$item->product->name!!}</a>
					</div>
					<div class="col-lg-2 mt-2 mt-lg-0 scoreComment">
						@for($i =0;$i < 5;$i++)
						@if($i < $item->score)
						<img src="hpbook/images/star.png" alt="star">
						@else
						<img src="hpbook/images/unstar.png" alt="unstar">
						@endif
						@endfor
					</div>
					<div class="col-lg-3 mt-2 mt-lg-0 contentComment">
						{!!$item->content!!}
					</div>
					<div class="col-lg-2 mt-2 mt-lg-0 contentComment">
						@if($item->status==1)
						Đã phê duyệt
						@else
						Chờ phê duyệt
						@endif
					</div>
					<div class="col-lg-2 mt-2 mt-lg-0 actionComment text-lg-right">
						<a href="{!!url('/chi-tiet-nhan-xet',$item->id)!!}" class="btn btn-success btn-sm viewDetailComment">Chi Tiết</a>
						<a href="javascript:void(0)" onclick="return confirm('Bạn có chắc muốn xóa không?')" class="btn btn-danger btn-sm deleteComment" data-id="{!!$item->id!!}" >Xóa</a>
					</div>
				</div>
				@endforeach
				<!-- end one comment -->
			</div> <!-- end my comment -->
		</div>
	</div>
	<!-- end content -->
@endsection
@section('script')
	<script type="text/javascript" src="hpbook/js/ajaxDeleteComment.js"></script>
@endsection