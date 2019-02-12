@extends('hpbook.master')
@section('title')
Nhà sách HPBOOK
@endsection
@section('content')
<!-- slider -->
	<div class="container">
		<div id="slider">
			<div class="row">
				<div class="col-3 d-md-block d-none">
						<a href="">
							<img class="imgBannerTop"  src="hpbook/images/46724557_2017163231695913_8130269221838913536_n.jpg" alt="46724557_2017163231695913_8130269221838913536_n.jpg">
						</a>
				</div>
				<div class="col-12 col-md-9">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
					    <div class="carousel-item  active">
					      <a href="{!!url('/the-loai',$slider[0]['link'])!!}"><img class="d-block w-100" src="admin_public/upload/sliders/{!!$slider[0]['image']!!}" alt="First slide"></a>
					    </div>
					    <div class="carousel-item">
					      <a href="{!!url('/the-loai',$slider[1]['link'])!!}"><img class="d-block w-100" src="admin_public/upload/sliders/{!!$slider[1]['image']!!}" alt="Second slide"></a>
					    </div>
					    <div class="carousel-item">
					      <a href="{!!url('/the-loai',$slider[2]['link'])!!}"><img class="d-block w-100" src="admin_public/upload/sliders/{!!$slider[2]['image']!!}" alt="Third slide"></a>
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end slider -->
	<!-- content -->
	<div class="container ">

		<!-- 1 block -->
		@foreach($category as $key => $item)
		@if($key==2)
		<div class="banner-mid mt-4">
			<div class="row">
				<div class="col-12">
					<a href="{!!url($banner[1]['link'])!!}">
						<img class="imgBannerMid" src="admin_public/upload/banners/{!!$banner[0]['image']!!}" alt="{!!$banner[0]['image']!!}">
					</a>
				</div>
			</div>
		</div>
		@endif
		<div class="mt-4 one-block">

			<div class="row">
				<div class="container title-block mb-2">
					<span class="title-icon"></span>
					<h2 class="title-text">{!!$item->name!!}</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-3 d-lg-block d-none wrapper-slide wrapper-slide">
					<div id="tab_noi_bat_{!!$item->id!!}" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
					  	@php
					  		$hightLight = DB::table('products')->where('cate_id',$item->id)->where('quantity','>',0)->inRandomOrder()->take(3)->get();
					  		$flag = 0;
					  	@endphp
					  	@foreach($hightLight as $hl)
					  	@if($flag==0)
						    <div class="carousel-item imageCarousel active">
						    <a href="{!!url('/chi-tiet',$hl->alias)!!}">
						    	<img class="d-block w-100" src="admin_public/upload/products/{!!$hl->image!!}" alt="{!!$hl->image!!}">
						    </a>
						     @if($hl->discount!=0)
						     	<div class="icon-discount-slide">{!!$hl->discount!!}%</div>
						     @endif
						    </div>
						    @php
						    	$flag = 1;
						    @endphp
						@else
							<div class="carousel-item imageCarousel">
							<a href="{!!url('/chi-tiet',$hl->alias)!!}">
								<img class="d-block w-100" src="admin_public/upload/products/{!!$hl->image!!}" alt="{!!$hl->image!!}">
							</a>
							@if($hl->discount!=0)
						     	<div class="icon-discount-slide">{!!$hl->discount!!}%</div>
						     @endif
						    </div>
					    @endif
					    @endforeach
					 
					  </div>
					  <a class="carousel-control-prev" href="#tab_noi_bat_{!!$item->id!!}" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#tab_noi_bat_{!!$item->id!!}" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12 wrapper-content-block">
					<div class="content-middle-block"></div>
						<ul class="nav nav-tabs myBorder1" id="myTab" role="tablist">
						  <li class="nav-item float-left">
						    <a class="nav-link active myColor" id="new-tab{!!$item->id!!}" data-toggle="tab" href="#new{!!$item->id!!}" role="tab" aria-controls="new{!!$item->id!!}" aria-selected="true">Mới nhất</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link float-left myColor" id="discount-tab{!!$item->id!!}" data-toggle="tab" href="#discount{!!$item->id!!}" role="tab" aria-controls="discount{!!$item->id!!}" aria-selected="false">Giảm giá</a>
						  </li>
						  <a class="nav-link text-right float-left myColor" href="{!!url('/the-loai',[$item->alias])!!}">Xem thêm</a>
						</ul>

						<div class="tab-content" id="myTabContent">
						<!-- new product -->
						  <div class="tab-pane fade show active" id="new{!!$item->id!!}" role="tabpanel" aria-labelledby="new-tab{!!$item->id!!}">
							<div id="myCarousel{!!$item->id!!}" class="carousel slide" data-ride="carousel" data-interval="0">
							<!-- Carousel indicators -->
							<!-- Wrapper for carousel items -->
								<div class="carousel-inner mt-2">
									@php
										$newProduct = DB::table('products')->where('cate_id',$item->id)->where('quantity','>',0)->orderBy('id','DESC')->skip(0)->take(9)->get()->toArray();
									@endphp
									<div class="item carousel-item active">
										<div class="row">
											@php
											for ($i=0; $i < 3; $i++) { 	
											@endphp
											<div class="col-4 mt-md-3 mt-lg-5">
												<div class="thumb-wrapper">
													<div class="img-box">
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}"><img src="admin_public/upload/products/{!!$newProduct[$i]->image!!}" class="img-responsive img-fluid" alt="{{$newProduct[$i]->image}}"></a>
													</div>
													<div class="thumb-content">
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}" data-toggle="tooltip" data-placement="right" title="{!!$newProduct[$i]->name!!}"><h4 class="text-capitalize">{!!$newProduct[$i]->name!!}</h4></a>
						
														<p class="item-price"><strike>{!! number_format($newProduct[$i]->price,0,",",".")!!} đ</strike> <span>{!!number_format(($newProduct[$i]->price) - ($newProduct[$i]->price)*$newProduct[$i]->discount/100,0,",",".")!!} đ</span></p>
													</div>
													<div class="wrapper-shopping">
														<a href="{!!url('/them-gio-hang',$newProduct[$i]->id)!!}" class="shopping-cart" data-id="{!!$newProduct[$i]->id!!}"><i class="fas fa-shopping-cart"></i></a>
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
													</div>
													@if($newProduct[$i]->discount!=0)
													<div class="discount-icon">{!!$newProduct[$i]->discount!!}%</div>
													@endif
												</div>
											</div>	
											@php
												}
											@endphp	
										</div>
									</div>
									<div class="item carousel-item">
										<div class="row">
											@php
											for ($i=3; $i < 6; $i++) { 	
											@endphp
											<div class="col-4 mt-md-3 mt-lg-5">
												<div class="thumb-wrapper">
													<div class="img-box">
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}"><img src="admin_public/upload/products/{!!$newProduct[$i]->image!!}" class="img-responsive img-fluid" alt="{{$newProduct[$i]->image}}"></a>
													</div>
													<div class="thumb-content">
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}" data-toggle="tooltip" data-placement="right" title="{!!$newProduct[$i]->name!!}"><h4 class="text-capitalize">{!!$newProduct[$i]->name!!}</h4></a>
						
														<p class="item-price"><strike>{!! number_format($newProduct[$i]->price,0,",",".")!!} đ</strike> <span>{!!number_format(($newProduct[$i]->price) - ($newProduct[$i]->price)*$newProduct[$i]->discount/100,0,",",".")!!} đ</span></p>
													</div>
													<div class="wrapper-shopping">
														<a href="{!!url('/them-gio-hang',$newProduct[$i]->id)!!}" class="shopping-cart" data-id="{!!$newProduct[$i]->id!!}"><i class="fas fa-shopping-cart"></i></a>
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
													</div>
													@if($newProduct[$i]->discount!=0)
													<div class="discount-icon">{!!$newProduct[$i]->discount!!}%</div>
													@endif
												</div>
											</div>	
											@php
												}
											@endphp						
										</div>
									</div>
									<div class="item carousel-item">
										<div class="row">						
											@php
											for ($i=6; $i < 9; $i++) { 	
											@endphp
											<div class="col-4 mt-md-3 mt-lg-5">
												<div class="thumb-wrapper">
													<div class="img-box">
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}"><img src="admin_public/upload/products/{!!$newProduct[$i]->image!!}" class="img-responsive img-fluid" alt="{{$newProduct[$i]->image}}"></a>
													</div>
													<div class="thumb-content">
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}" data-toggle="tooltip" data-placement="right" title="{!!$newProduct[$i]->name!!}"><h4 class="text-capitalize">{!!$newProduct[$i]->name!!}</h4></a>
						
														<p class="item-price"><strike>{!! number_format($newProduct[$i]->price,0,",",".")!!} đ</strike> <span>{!!number_format(($newProduct[$i]->price) - ($newProduct[$i]->price)*$newProduct[$i]->discount/100,0,",",".")!!} đ</span></p>
													</div>
													<div class="wrapper-shopping">
														<a href="{!!url('/them-gio-hang',$newProduct[$i]->id)!!}" class="shopping-cart" data-id="{!!$newProduct[$i]->id!!}"><i class="fas fa-shopping-cart"></i></a>
														<a href="{!!url('/chi-tiet',$newProduct[$i]->alias)!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
													</div>
													@if($newProduct[$i]->discount!=0)
													<div class="discount-icon">{!!$newProduct[$i]->discount!!}%</div>
													@endif
												</div>
											</div>	
											@php
												}
											@endphp	
										</div>
									</div>
								</div>
							<!-- Carousel controls -->
								<a class="carousel-control left carousel-control-prev" href="#myCarousel{!!$item->id!!}" data-slide="prev">
									<i class="fas fa-angle-left"></i>
								</a>
								<a class="carousel-control right carousel-control-next" href="#myCarousel{!!$item->id!!}" data-slide="next">
									<i class="fas fa-angle-right"></i>
								</a>
							</div>
						  </div>
						 <!-- end new product -->
						<!-- product discount -->
						  <div class="tab-pane fade" id="discount{!!$item->id!!}" role="tabpanel" aria-labelledby="discount-tab{!!$item->id!!}">
						  	<div id="myCarousel1{!!$item->id!!}" class="carousel slide" data-ride="carousel" data-interval="0">
							<!-- Carousel indicators -->
							<!-- Wrapper for carousel items -->
							<div class="carousel-inner mt-2">
								@php
									$discountProduct = DB::table('products')->where('cate_id',$item->id)->where('quantity','>',0)->orderBy('discount','DESC')->skip(0)->take(9)->get()->toArray();
								@endphp
								<div class="item carousel-item active">
									<div class="row">
										@php
											for ($i=0; $i < 3; $i++) { 	
											@endphp
											<div class="col-4 mt-md-3 mt-lg-5">
												<div class="thumb-wrapper">
													<div class="img-box">
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}"><img src="admin_public/upload/products/{!!$discountProduct[$i]->image!!}" class="img-responsive img-fluid" alt="{{$discountProduct[$i]->image}}"></a>
													</div>
													<div class="thumb-content">
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}" data-toggle="tooltip" data-placement="right" title="{!!$discountProduct[$i]->name!!}"><h4 class="text-capitalize">{!!$discountProduct[$i]->name!!}</h4></a>
						
														<p class="item-price"><strike>{!! number_format($discountProduct[$i]->price,0,",",".")!!} đ</strike> <span>{!!number_format(($discountProduct[$i]->price) - ($discountProduct[$i]->price)*$discountProduct[$i]->discount/100,0,",",".")!!} đ</span></p>
													</div>
													<div class="wrapper-shopping">
														<a href="{!!url('/them-gio-hang',$discountProduct[$i]->id)!!}" class="shopping-cart" data-id="{!!$discountProduct[$i]->id!!}"><i class="fas fa-shopping-cart"></i></a>
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
													</div>
													@if($discountProduct[$i]->discount!=0)
													<div class="discount-icon">{!!$discountProduct[$i]->discount!!}%</div>
													@endif
												</div>
											</div>	
											@php
												}
											@endphp	
									</div>
								</div>
								<div class="item carousel-item">
									<div class="row">
										@php
											for ($i=3; $i < 6; $i++) { 	
											@endphp
											<div class="col-4 mt-md-3 mt-lg-5">
												<div class="thumb-wrapper">
													<div class="img-box">
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}"><img src="admin_public/upload/products/{!!$discountProduct[$i]->image!!}" class="img-responsive img-fluid" alt="{{$discountProduct[$i]->image}}"></a>
													</div>
													<div class="thumb-content">
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}" data-toggle="tooltip" data-placement="right" title="{!!$discountProduct[$i]->name!!}"><h4 class="text-capitalize">{!!$discountProduct[$i]->name!!}</h4></a>
						
														<p class="item-price"><strike>{!! number_format($discountProduct[$i]->price,0,",",".")!!} đ</strike> <span>{!!number_format(($discountProduct[$i]->price) - ($discountProduct[$i]->price)*$discountProduct[$i]->discount/100,0,",",".")!!} đ</span></p>
													</div>
													<div class="wrapper-shopping">
														<a href="{!!url('/them-gio-hang',$discountProduct[$i]->id)!!}" class="shopping-cart" data-id="{!!$discountProduct[$i]->id!!}"><i class="fas fa-shopping-cart"></i></a>
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
													</div>
													@if($discountProduct[$i]->discount!=0)
													<div class="discount-icon">{!!$discountProduct[$i]->discount!!}%</div>
													@endif
												</div>
											</div>	
											@php
												}
											@endphp						
									</div>
								</div>
								<div class="item carousel-item">
									<div class="row">						
										@php
											for ($i=6; $i < 9; $i++) { 	
											@endphp
											<div class="col-4 mt-md-3 mt-lg-5">
												<div class="thumb-wrapper">
													<div class="img-box">
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}"><img src="admin_public/upload/products/{!!$discountProduct[$i]->image!!}" class="img-responsive img-fluid" alt="{{$discountProduct[$i]->image}}"></a>
													</div>
													<div class="thumb-content">
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}" data-toggle="tooltip" data-placement="right" title="{!!$discountProduct[$i]->name!!}"><h4 class="text-capitalize">{!!$discountProduct[$i]->name!!}</h4></a>
						
														<p class="item-price"><strike>{!! number_format($discountProduct[$i]->price,0,",",".")!!} đ</strike> <span>{!!number_format(($discountProduct[$i]->price) - ($discountProduct[$i]->price)*$discountProduct[$i]->discount/100,0,",",".")!!} đ</span></p>
													</div>
													<div class="wrapper-shopping">
														<a href="{!!url('/them-gio-hang',$discountProduct[$i]->id)!!}" class="shopping-cart" data-id="{!!$discountProduct[$i]->id!!}"><i class="fas fa-shopping-cart"></i></a>
														<a href="{!!url('/chi-tiet',$discountProduct[$i]->alias)!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
													</div>
													@if($discountProduct[$i]->discount!=0)
													<div class="discount-icon">{!!$discountProduct[$i]->discount!!}%</div>
													@endif
												</div>
											</div>	
											@php
												}
											@endphp	
									</div>
								</div>
							</div>
							<!-- Carousel controls -->
							<a class="carousel-control left carousel-control-prev" href="#myCarousel1{!!$item->id!!}" data-slide="prev">
								<i class="fas fa-angle-left"></i>
							</a>
							<a class="carousel-control right carousel-control-next" href="#myCarousel1{!!$item->id!!}" data-slide="next">
								<i class="fas fa-angle-right"></i>
							</a>
							</div>
						  </div>
						  <!--end product discount -->
						</div>
				</div>
				<!-- right block -->
				<div class="col-sm-3 d-lg-block d-none">
					<div class="wrapper">
						<div class="top-right-block">
							Sách bán chạy nhất
						</div>
						<div class="content-right-block">
							<ul class="right-block-item">
								@php
									$bestSaleProduct = DB::table('products')->where('cate_id',$item->id)->where('quantity','>',0)->orderBy('count_buy','DESC')->skip(0)->take(5)->get();
									$i = 1;
								@endphp
								@foreach($bestSaleProduct as $bsp)
									<li class="item">
										<span class="item-icon">{!!$i!!}</span>
										<div class="item-wrapper">
											<span class="item-name text-capitalize"><a href="{!!url('/chi-tiet',$bsp->alias)!!}" data-toggle="tooltip" data-placement="left" title="{!!$bsp->name!!}">{!!$bsp->name!!}</a></span>
											<span class="item-price1">{!! number_format($bsp->price-$bsp->price*$bsp->discount/100,0,",",".")!!} đ</span>
											<span class="item-discount"><strike>{!! number_format($bsp->price,0,",",".")!!} đ</strike></span>
										</div>
									</li>
									@php
										$i = $i+1;
									@endphp
								@endforeach
								
							</ul>
						</div>
					</div>
				</div>
				<!-- right block -->
			</div>
		</div>
		@endforeach
		<div class="banner-top mt-4 mb-0">
			<div class="row">
			<div class="col-12">
			<a href="{!!url($banner[1]['link'])!!}">
			<img class="imgBannerMid" src="admin_public/upload/banners/{!!$banner[1]['image']!!}" alt="{!!$banner[1]['image']!!}">
			</a>
			</div>
			</div>
		</div>
	</div>
	<!-- end content-->
	
@endsection
