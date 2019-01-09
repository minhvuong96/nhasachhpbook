@extends('hpbook.master')
@section('title')
Nhận Xét - HPBOOK
@endsection
@section('css')
	<link rel="stylesheet" href="hpbook/css/style-detail-comment.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/nhan-xet-cua-toi')!!}">Nhận Xét Của Tôi</a></li>
				    <li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Chi Tiết Nhận Xét</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
		<div class="container">
			<div class="detailComment">
				<div class="row">
					<div class="col-12">
						<h4 id="titleDetailComment">Nhận Xét</h4>
						@include('hpbook.blocks.message')
					</div>
				</div>
				<form action="{!!url('/chi-tiet-nhan-xet',$myComment->id)!!}" method="post" class="row mt-5 clearfix">
					<input type="hidden" name="_token" value="{!!csrf_token()!!}">
					<div class="col-md-5 col-xl-3">
						<img class="imageDetailComment mr-3" src="admin_public/upload/products/{!!$myComment->product->image!!}" alt="{!!$myComment->product->alias!!}">
						<a href="{!!url('/chi-tiet',$myComment->product->alias)!!}" class="nameProductDetailComment text-capitalize">{!!$myComment->product->name!!}</a>
						<div class="scoreDetailComment mt-3">
							@for($i =0;$i < 5;$i++)
							@if($i < $myComment->score)
							<img src="hpbook/images/star.png" alt="star">
							@else
							<img src="hpbook/images/unstar.png" alt="unstar">
							@endif
							@endfor
						</div>
					</div> <!-- end col -->
					<div class="col-md-7 col-xl-5">
						<span class="dateDetailComment">Ngày đăng: @php
							$dateComment = date("d/m/Y",strtotime($myComment->updated_at));
							echo $dateComment;
						@endphp</span>
						<table class="table-responsive">
							<tr>
								<th></th>
								<th>
									<span class="labelStar">1 Sao</span>
								</th>
								<th>
									<span class="labelStar">2 Sao</span>
								</th>
								<th>
									<span class="labelStar">3 Sao</span>
								</th>
								<th>
									<span class="labelStar">4 Sao</span>
								</th>
								<th>
									<span class="labelStar">5 Sao</span>
								</th>
							</tr>
							<tr>
								<td>
									<div class="label">Đánh Giá</div>
								</td>
								<td class="th">
									<input type="radio" name="voteStar" class="voteStart" value="1" @if($myComment->score==1)checked="checked"@endif>1
								</td>
								<td class="th">
									<input type="radio" name="voteStar" class="voteStart" value="2" @if($myComment->score==2)checked="checked"@endif>2
								</td>
								<td class="th">
									<input type="radio" name="voteStar" class="voteStart" value="3" @if($myComment->score==3)checked="checked"@endif>3
								</td>
								<td class="th">
									<input type="radio" name="voteStar" class="voteStart" value="4" @if($myComment->score==4)checked="checked"@endif>4
								</td>
								<td class="th">
									<input type="radio" name="voteStar" class="voteStart" value="5" @if($myComment->score==5)checked="checked"@endif>5
								</td>
							</tr>
						</table>
					</div> <!-- end col -->
					<div class="col-md-12 col-xl-4 mt-4 mt-xl-0">
						<textarea name="content" id="content" cols="35" rows="7" required="required">{!!$myComment->content!!}
						</textarea>
						<button type="submit" class="btn btn-primary mt-2" id="saveComment">Gửi</button>
					</div> <!-- end col -->
				</form> <!-- end row -->
			</div> <!-- end detail Comment -->
		</div> <!-- end container -->
	</div>
	<!-- end content -->
@endsection
@section('script')
	
@endsection