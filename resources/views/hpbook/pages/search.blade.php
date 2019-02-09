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
                                <h5>Tìm thấy <strong>{!!$count!!}</strong> sản phẩm</h5>
                                <div class="mt-sm-4">
                                        
                                    <div class="row">
                                        @foreach($data as $item)
                                        <div class="col-6 col-lg-4 col-xl-3">
                                            <div class="thumb-wrapper thumb-wrapper2">
                                                <div class="img-box img-box-product">
                                                <a href="{!!url('/chi-tiet',$item['alias'])!!}"><img class="img-product" src="admin_public/upload/products/{!!$item['image']!!}" class="img-responsive img-fluid" alt="{{$item['image']}}"></a>
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
                </div>
            </div>
        </div>
@endsection
@section('script')
@endsection