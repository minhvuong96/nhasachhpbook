@extends('hpbook.master')
@section('title')
Chi Tiết Đơn Hàng - HPBOOK
@endsection
@section('css')
		<!-- style page cart -->
	<link rel="stylesheet" href="hpbook/css/style-detail-order.css">
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
				    <li class="breadcrumb-item active breadcrumbText text-capitalize bcActive" aria-current="page">Chi Tiết Đơn Hàng</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
		<div class="container clearfix">
            <div class="col-12 wrapper mt-0">
                        <div class="clearfix">
                            <div class="float-left">
                                <h4>Đơn hàng <a href="javascript:void(0)">#{!!$transaction->id!!}</a></h4>
                                <div class="timeOrder">Đặt ngày @php
                                    $dateOrder = date("d/m/Y H:i:s",strtotime($transaction->created_at));
                                    echo $dateOrder;
                                @endphp</div>
                            </div>
                            <div href="#" class="float-right total">Tổng: {!!number_format($transaction->amount_total,0,',','.')!!} đ</div>
                        </div>
                    <!-- 1 đơn hàng -->
                    <div class="row mt-3">
                        <div class="col-12">
                            @if($transaction->status==4)
                            <div class="float-left timeStatus">Đã giao hàng ngày @php
                                    $dateOrder = date("d/m/Y",strtotime($transaction->created_at));
                                    echo $dateOrder;
                                @endphp</div>
                            @endif
                            @if($transaction->status<2)
                            <a href="{!!url('/huy-don-hang',$transaction->id)!!}" class="float-right cancelOrder">HỦY ĐƠN HÀNG</a>
                            @else
                            <span class="float-right cancelOrder">Liên hệ để hủy</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <div class="progress">
                                @switch($transaction->status)
                                @case(1)
                                    
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">Đang xử lý</div>
                                    @break

                                @case(2)
                                   
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">Đã tiếp nhận</div>
                                    @break
                                @case(3)
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">Đang giao hàng</div>
                                    @break
                                @case(4)
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Đã giao hàng</div>
                                    @break
                                @default
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Đã hủy</div>
                                @endswitch
                                
                                
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    <div class="row mt-2 mb-4">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 wrapper-process">
                                <div class="process mt-0">
                                    <span class="timeProcess mr-3">@php
                                            $dateOrder = date("d/m/Y H:i",strtotime($transaction->created_at));
                                            echo $dateOrder;
                                        @endphp</span>
                                    <span class="contentProcess">Cảm ơn bạn đã đặt hàng tại HPBOOK.</span>
                                </div>
                                @if($transaction->status ==2)
                                <div class="process mt-2">
                                    <span class="timeProcess mr-3">@php
                                            $dateOrder = date("d/m/Y H:i",strtotime($transaction->updated_at));
                                            echo $dateOrder;
                                        @endphp</span>
                                    <span class="contentProcess">Đơn hàng của bạn đã được tiếp nhận và xử lý.</span>
                                </div>
                                @endif
                                @if($transaction->status ==3)
                                <div class="process mt-2">
                                    <span class="timeProcess mr-3">@php
                                            $dateOrder = date("d/m/Y H:i",strtotime($transaction->updated_at));
                                            echo $dateOrder;
                                        @endphp</span>
                                    <span class="contentProcess">Đơn hàng của bạn đã được giao cho bộ phận giao hàng.</span>
                                </div>
                                @endif
                                @if($transaction->status ==4)
                                <div class="process mt-2">
                                        <span class="timeProcess mr-3">@php
                                                $dateOrder = date("d/m/Y H:i",strtotime($transaction->updated_at));
                                                echo $dateOrder;
                                            @endphp</span>
                                        <span class="contentProcess">Đơn hàng đã được giao cho bạn thành công.</span>
                                </div>
                                @endif
                                @if($transaction->status==5)
                                <div class="process mt-2">
                                        <span class="timeProcess mr-3">@php
                                                $dateOrder = date("d/m/Y H:i",strtotime($transaction->updated_at));
                                                echo $dateOrder;
                                            @endphp</span>
                                        <span class="contentProcess">Đơn hàng đã bị hủy.</span>
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-2"></div>
                    </div>
                    <div class="row contentOrder">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            @foreach($transaction->products as $product)
                            <div class="row mt-3">
                                    <div class="col-sm-6 productOrder">
                                            <a href="{!!url('/chi-tiet',$product->alias)!!}" class="float-left"><img class="mr-2" src="admin_public/upload/products/{!!$product->image!!}" alt="{!!$product->alias!!}"></a>
                                            <span class="productName">{!!$product->name!!}</span>
                                            
                                        </div>
                                        <div class="col-sm-4 mt-3 mt-sm-0">
                                                <span class="priceUnit">{!!number_format($product->price-$product->price*$product->discount/100,0,',','.')!!} đ</span>
                                        </div>
                                        @php
                                            $quantity = DB::table('product_transaction')->where('product_id',$product->id)->where('transaction_id',$transaction->id)->first()->quantity;
                                        @endphp
                                        <div class="col-sm-2 productStatus">
                                            <span class="quantity">Qty: <b>{!!$quantity!!}</b></span>
                                        </div>
                            </div>
                            @endforeach                 
                        </div>
                        <div class="col-sm-2"></div>
                        
                    </div>                              
                    <!--end 1 đơn hàng -->
            </div>
            <div class="col-sm-6 pr-0 pr-sm-2 pl-0 float-left">
                    <div class="wrapper addressBlock">
                            <h4>Địa chỉ khách hàng</h4>
                            <div class="nameAddress">{{Auth::user()->name}}</div>
                            <div class="detailAddress">{{Auth::user()->address}}</div>
                            <div class="phone mt-4">{{Auth::user()->phone}}</div>
                        </div>
                        <div class="wrapper addressBlock">
                            <h4>Địa chỉ giao hàng</h4>
                            <div class="nameAddress">{{Auth::user()->name}}</div>
                            <div class="detailAddress">@if(isset(Auth::user()->other_address)){{Auth::user()->other_address}}@else{{Auth::user()->address}} @endif</div>
                            <div class="phone mt-4">{{Auth::user()->phone}}</div>
                        </div>
            </div>
            <div class="col-sm-6 wrapper payBlock float-right">
                <h4>Tổng cộng</h4>
                <div class="clearfix">
                    <div class="float-left">Tạm tính:</div>
                    <span class="amount_temporary float-right">{!!number_format($transaction->amount_temporary,0,',','.')!!} đ</span>
                </div>
                <div class="clearfix">
                    <div class="float-left">Phí vận chuyển:</div>
                    <span class="amount_ship float-right">@if($transaction->amount_shipping==0)đang tính @else {!!number_format($transaction->amount_shipping,0,',','.')!!} đ @endif</span>
                </div>
                <div class="clearfix">
                    <div class="float-left">Giảm giá:</div>
                    <span class="amount_ship float-right">@if($transaction->amount_discount!=0){!!number_format($transaction->amount_discount,0,',','.')!!} đ @endif</span>
                </div>
                <br/>
                <div class="clearfix">
                    <div class="float-left">Tổng cộng:</div>
                    <span class="amount_total float-right">{!!number_format($transaction->amount_total,0,',','.')!!} đ</span>
                </div>
                <div class="payment">Thanh toán bằng hình thức 
                    @if($transaction->payment==1)
                    sử dụng thẻ tín dụng
                    @elseif($transaction->payment==2)
                    chuyển khoản
                    @else
                    COD
                    @endif
                </div>
            </div>
        </div>
     
		</div>
		<!-- end container -->
	</div>
	<!-- end content -->
@endsection