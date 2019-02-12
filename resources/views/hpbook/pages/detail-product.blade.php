@extends('hpbook.master')
@section('title')
{!!$product->name!!} - HPBOOK
@endsection
@section('css')
	<!-- style page detail product -->
	<link rel="stylesheet" href="hpbook/css/style-detail-product.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item breadcrumbText text-capitalize"><a href="{!!url('/the-loai',$cate->alias)!!}">{!!$cate->name!!}</a></li>
				    <li class="breadcrumb-item active breadcrumbText text-capitalize bcActive" aria-current="page">{!!$product->name!!}</li>
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
				<div class="col-sm-9">
					<div class="row bg-content">
						<div class="col-lg-3 col-8 col-sm-6 content-left">
							<div class="imgDetailProduct">
								<img class="img-thumbnail" src="admin_public/upload/products/{!!$product->image!!}" alt="{!!$product->alias!!}">
							</div>
						</div>
						<!-- end content left -->
						<div class="col-lg-6 col-12 col-sm-6 content-mid">
							<h1 class="titleDetailProduct">{!!$product->name!!}</h1>
							<div class="priceDetailProduct">
								<span class="newPrice">{!!number_format($product->price - $product->price*$product->discount/100,0,",",".")!!} đ</span>
								@if($product->discount!=0)
								<span class="oldPrice"><strike>{!!number_format($product->price,0,",",".")!!} đ</strike></span>
								@endif
							</div>
							@if($product->discount!=0)
							<span class="discountDetailProduct">-{!!$product->discount!!}%</span>
							@endif
							<hr >
							<form action="{!!url('/them-gio-hang-co-so-luong')!!}" method="post">
								@csrf
								<span class="qty">Số lượng: </span>
								<input type="number" value="1" min="1" max="{!!$product->quantity!!}" name="ipQty" class="ipQty">
								<input type="hidden" name="idProduct" value="{!!$product->id!!}">
								@if($product->quantity!=0)
								<button type="submit" class="btn btn-primary float-xl-right mt-2 mt-xl-0">Thêm giỏ hàng</button>
							</form>
							<form action="{!!url('/nut-thanh-toan')!!}" method="post">
								@csrf
								<input type="hidden" name="ipHiddenQty" id="ipHiddenQty" value="1">
								<input type="hidden" name="idProduct" value="{!!$product->id!!}">
								<button type="submit" class="btn btn-success btn-block paymentDetailProduct">Thanh toán</button>
							</form>
							@endif
							<hr >
							<div class="policiesDetailProduct clearfix">
								
								<ul>
									<li class="col-sm-6 float-left">
										<i class="fas fa-truck-moving mr-2"></i><a href="javascript:void(0)">Giao hàng toàn quốc</a>
									</li>
									<li class="col-sm-6 float-left">
										<i class="fas fa-gift mr-2"></i><a href="javascript:void(0)">Bọc sách plastic cao cấp</a>
									</li>
									<li class="col-sm-6 float-left">
										<i class="fas fa-undo mr-2"></i><a href="javascript:void(0)">Đổi trả trong 3 ngày</a>
									</li>
									<li class="col-sm-6 float-left">
										<i class="fas fa-hand-holding-usd mr-2"></i><a href="javascript:void(0)">Thanh toán khi nhận hàng</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 mt-lg-0 mt-3 wrapper-attr">
							<div class="attrDetailProduct">
								<label for="">NXB: </label>
								{!!$publisher->name!!}
							</div>
							<div class="attrDetailProduct">
								<label for="">Tác giả: </label>
								@foreach($authors as $author)
									- {!!$author->name!!}<br/>
								@endforeach
							</div>
							<div class="attrDetailProduct">
								<label for="">Năm: </label>
								{!!$product->publish_year!!}
							</div>
							<div class="attrDetailProduct">
								<label for="">Tình trạng: </label>
								@if($product->quantity ==0)
									Hết hàng
								@else
									Còn hàng ({!!$product->quantity!!} quyển)
								@endif
							</div>
						</div>
					</div>
					<div class="row mt-3 descriptionDetailProduct">
						<div class="col-12 bg-content">
							<h2>Mô tả</h2>
							<hr>
							<div class="description-content">
								{!!$product->description!!}
							</div>
						</div>
					</div>
					<div class="row mt-3 commentDetailProduct">
						<div class="col-12 bg-content">
							<h3 class="titleListComment">Đánh giá và nhận xét về tác phẩm <strong>{!!$product->name!!}</strong></h3>
							<hr>
							<div class="score">
								<span class="score-average">{!!$product->rating!!}</span>
								<span class="score-max">/5</span>
								<img src="hpbook/images/star.png" alt="unstar">
							</div>
							<h4>Nhận xét về tác phẩm</h4>
							@if(count($comment)==0)
								<div>Chưa có nhận xét nào</div>
							@else
							@foreach($comment as $item)
							<div class="listComment">
								<div class="score-comment">
									@for($i =0;$i < 5;$i++)
									@if($i < $item->score)
									<img src="hpbook/images/star.png" alt="star">
									@else
									<img src="hpbook/images/unstar.png" alt="unstar">
									@endif
									@endfor
								</div>
								@php
									$user_comment = DB::table('users')->where('id',$item->user_id)->first()
								@endphp
								<div class="content-comment small">
									<?php
                                        echo \Carbon\Carbon::createFromTimeStamp(strtotime($item['created_at']))->diffForHumans();
                                    ?>
								</div>

								<div class="username-comment">bởi 
									{!!$user_comment->name!!}
								</div>
								<div class="content-comment">
									{{$item->content}}
								</div>
							</div>
							@endforeach
							<div class="row ">
									<div class="mt-4 ml-3 small">
										{{ $comment->links('vendor.pagination.name') }}
									</div>
							</div>
							@endif
							<div class="yourComment">
								<h4>Bạn đang nhận xét cho tác phẩm <strong>{!!$product->name!!}</strong></h4>
								@if(Auth::check())
								@include('hpbook.blocks.message')
								<form action="{!!url('/chi-tiet',$product->alias)!!}" method="post">
									<input type="hidden" name="_token" value="{!!csrf_token()!!}">
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
												<span class="label">Đánh giá</span>
											</td>
											<td class="th">
												<input type="radio" name="voteStar" class="voteStart" value="1">
											</td>
											<td class="th">
												<input type="radio" name="voteStar" class="voteStart" value="2">
											</td>
											<td class="th">
												<input type="radio" name="voteStar" class="voteStart" value="3">
											</td>
											<td class="th">
												<input type="radio" name="voteStar" class="voteStart" value="4">
											</td>
											<td class="th">
												<input type="radio" name="voteStar" class="voteStart" value="5" checked="checked">
											</td>
										</tr>
									</table>
									<div class="form-group mt-4 contentYourComment">
									    <label for="content">Nội dung bình luận</label>
									    <textarea required="required" class="form-control" name="content1" id="content1" rows="3"></textarea>
									    {{-- captcha --}}
								        <div class="form-group mt-3">
								            <div class="captcha">
								               <span>{!! captcha_img() !!}</span>
								               <button type="button" class="btn btn-success"><i class="fas fa-sync-alt" id="refresh"></i></button>
								            </div>
								        </div>
								        <div class="form-group">
								             <input id="captcha" type="text" class="form-control w-25" placeholder="Nhập Captcha" name="captcha">
								         </div>
								        {{-- end captcha --}}
									    <button type="submit" class="btn btn-success btnThem" name="btnThem">Thêm bình luận</button>
									 </div>
								 </form>
								 @else
								 	<div class="requiredLogin"><a href="{!!url('dang-nhap')!!}">Đăng nhập</a> để bình luận.</div>
								 @endif
							</div>
						</div>
					</div>
				</div>
					<!-- end content mid -->
				<div class="col-sm-3 d-md-block d-none content-right">
					<!-- sản phẩm liên quan -->
						<div class="sale-product clearfix sale-detail-product">
							<div class="text-capitalize title-sale-product title-sale-product2">
								Sản phẩm liên quan
							</div>
							<div class="content-sale-product">
								<!-- 1 sản phẩm -->
								@foreach($relateProduct as $item)
								<div class="one-item one-item2">
									<a class="float-left" href="{!!url('/chi-tiet',$item->alias)!!}"><img src="admin_public/upload/products/{!!$item->image!!}" alt="{!!$item->alias!!}"></a>
									<span class="name-one-item text-capitalize"><a href="{!!url('/chi-tiet',$item->alias)!!}">{!!$item->name!!}</a></span><br>
									<span class="price-one-item">{!!number_format(($item->price) - ($item->price)*$item->discount/100,0,",",".")!!} đ</span>
									<span class="discount-one-item"><strike>{!! number_format($item->price,0,",",".")!!} đ</strike></span>
								</div>
								@endforeach
								<!--end 1 sản phẩm -->
							</div>
						</div>
						<!-- sản phẩm bán chạy nhất -->
						<div class="sale-product clearfix mt-4 sale-detail-product">
							<div class="text-capitalize title-sale-product title-sale-product2">
								Bán chạy nhất
							</div>
							<div class="content-sale-product">
								<!-- 1 sản phẩm -->
								@foreach($bestSellerProduct as $item)
								<div class="one-item">
									<a class="float-left" href="{!!url('/chi-tiet',$item->alias)!!}"><img src="admin_public/upload/products/{!!$item->image!!}" alt="{!!$item->alias!!}"></a>
									<span class="name-one-item text-capitalize"><a href="{!!url('/chi-tiet',$item->alias)!!}">{!!$item->name!!}</a></span><br>
									<span class="price-one-item">{!!number_format(($item->price) - ($item->price)*$item->discount/100,0,",",".")!!} đ</span>
									<span class="discount-one-item"><strike>{!! number_format($item->price,0,",",".")!!} đ</strike></span>
								</div>
								@endforeach
								<!--end 1 sản phẩm -->
							</div>
						</div>
				</div>
			</div>
			
		</div>
	</div>
	<!-- end content -->
@endsection
@section('script')
	<script type="text/javascript">
		$('.ipQty').change(function(event) {
			/* Act on the event */
			$('#ipHiddenQty').val($('.ipQty').val());
		});
	</script>
	<script type="text/javascript">
	$('#refresh').click(function(){
	  $.ajax({
	     type:'GET',
	     url:'refreshcaptcha',
	     success:function(data){
	        $(".captcha span").html(data.captcha);
	     }
	  });
	});
	</script>
@endsection