@extends('hpbook.master')
@section('title')
Kết Quả Tìm Kiếm - HPBOOK
@endsection
@section('content')
	<!-- breadcrumb -->
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
					    <li class="breadcrumb-item active breadcrumbText bcActive text-capitalize" aria-current="page">Kết Quả Tìm Kiếm</li>
					  </ol>
					</nav>
				</div>
			</div>
		</div>
	<!-- end breadcrumb -->
    <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="content-left">
                            <div class="toolbar">
                                {{-- <div class="row">
                                    <div class="col-12 sort">
                                        <form action="">
                                            <div class="form-group">
                                                <label for="sortSelect" id="labelSortSelect">Sắp xếp theo:  </label>
                                                <select class="form-control d-inline-block w-100%" id="sortSelect" name="sortSelect">
                                                  <option>Bán chạy nhất</option>
                                                  <option>Giá tăng dần</option>
                                                  <option>Giá giảm dần</option>
                                                  <option>Mới nhất</option>
                                                  <option>Cũ nhất</option>
                                                </select>
                                              </div>
                                        </form>
                                    </div>
                                </div> --}}
                                <h5>Tìm thấy <strong>{!!$count!!}</strong> sản phẩm</h5>
                                <div class="mt-sm-4">
                                        
                                    <div class="row">
                                        @foreach($data as $item)
                                        <div class="col-6 col-lg-4 col-xl-3">
                                            <div class="thumb-wrapper thumb-wrapper2">
                                                <div class="img-box img-box-product">
                                                    <a href="{!!url('/chi-tiet',$item['alias'])!!}"><img class="img-product" src="admin_public/upload/products/{!!$item['image']!!}" class="img-responsive img-fluid" alt=""></a>
                                                </div>
                                                <div class="thumb-content">
                                                    <a href="{!!url('/chi-tiet',$item['alias'])!!}" data-toggle="tooltip" data-placement="right" title="{!!$item['image']!!}"><h4 class="text-capitalize">{!!$item['name']!!}</h4></a>
                                                    
                                                        <p class="item-price"><strike>{!!number_format($item['price'],0,",",".") !!} đ</strike> <span class="d-block d-xl-inline">{!! number_format($item['price']-$item['price']*$item['discount']/100,0,",",".")!!} đ</span></p>
                                                    </div>
                                                    <div class="wrapper-shopping">
                                                        <a href="{!!url('/them-gio-hang',$item['id'])!!}" class="shopping-cart"><i class="fas fa-shopping-cart"></i></a>
                                                        <a href="{!!url('/chi-tiet',$item['alias'])!!}" class="view-detail"><i class="fas fa-search-plus"></i></a>
                                                    </div>
                                                    @if($item['discount']!=0)
                                                    <div class="discount-icon">{!!$item['discount']!!}%</div>
                                                    @endif	
                                            </div>
                                        </div>
                                        @endforeach
    
                                    </div>
                                    <div class="row ">
                                        <div class="mt-4 ml-3">
                                            {{ $data->links('vendor.pagination.name') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-3 d-md-block d-none">
                        <div class="content-right">
                            <!-- filter -->
                            <div class="filter">
                                <div class="author-filter">
                                    <div class="form-group">
                                        <label for="selectAuthor" class="title-filter">Tác Giả</label>
                                        <select class="form-control select-filter" name="selectAuthor" >
                                          <option>Chọn tác giả</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                        </select>
                                     </div>
                                </div>
                                <div class="publisher-filter">
                                    <div class="form-group">
                                        <label for="selectPublisher" class="title-filter">Nhà Xuất Bản</label>
                                        <select class="form-control select-filter" name="selectPublisher">
                                          <option>Chọn nhà xuất bản</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                        </select>
                                     </div>
                                </div>
                            </div>
                            <!-- end filter -->
                            <!-- sale product -->
                            <div class="sale-product clearfix">
                                <div class="title-sale-product">
                                    Giảm giá nhiều nhất
                                </div>
                                <div class="content-sale-product">
                                    <!-- 1 sản phẩm -->
                                    @foreach($saleProduct as $item)
                                    <div class="one-item ">
                                        <a class="float-left" href="{!!url('/chi-tiet',$item->alias)!!}"><img src="admin_public/upload/products/{!!$item->image!!}" alt=""></a>
                                        <span class="name-one-item "><a href="{!!url('/chi-tiet',$item->alias)!!}">{!!$item->name!!}</a></span><br>
                                        <span class="price-one-item">{!!number_format($item->price - $item->price*$item->discount/100,0,",",".")!!} đ</span>
                                        <span class="discount-one-item"><strike>{!!number_format($item->price,0,",",".")!!} đ</strike></span>
                                    </div>
                                    @endforeach
                                    <!--end 1 sản phẩm -->
                                </div>
                            </div>
                            <!-- sale product -->
                            <!-- bestseller product -->
                            <div class="sale-product clearfix">
                                <div class="title-sale-product">
                                    Bán chạy nhất
                                </div>
                                <div class="content-sale-product">
                                    <!-- 1 sản phẩm -->
                                    @foreach($bestSellerProduct as $item)
                                    <div class="one-item">
                                        <a class="float-left" href="{!!url('/chi-tiet',$item->alias)!!}"><img src="admin_public/upload/products/{!!$item->image!!}" alt=""></a>
                                        <span class="name-one-item "><a href="{!!url('/chi-tiet',$item->alias)!!}">{!!$item->name!!}</a></span><br>
                                        <span class="price-one-item">{!!number_format($item->price - $item->price*$item->discount/100,0,",",".")!!} đ</span>
                                        <span class="discount-one-item"><strike>{!!number_format($item->price,0,",",".")!!} đ</strike></span>
                                    </div>
                                    @endforeach
                                    <!--end 1 sản phẩm -->
                                </div>
                            </div>
                            <!-- bestseller newproduct -->
    
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
@endsection
@section('script')
@endsection