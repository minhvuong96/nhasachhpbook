
<header>
		<div class="container">
		<!-- top header -->
			<div id="top-header" class="clearfix p-2" > 
					<div class="float-right">
							@if(Auth::check())
					        <a class=" dropdown-toggle " href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

					          Tài khoản {!! Auth::user()->name !!}
					        </a>
					        <span class="dropdown-menu myDropdown" >
					          <a class="dropdown-item" href="{!!url('/don-hang-cua-toi')!!}">Đơn hàng của tôi</a>
					          <a class="dropdown-item" href="{!!url('/nhan-xet-cua-toi')!!}">Nhận xét của tôi</a>
					          <a class="dropdown-item" href="{!!url('/doi-mat-khau')!!}">Đổi mật khẩu</a>
					          <a class="dropdown-item" href="{!!url('/dang-xuat')!!}">Đăng xuất</a>
					        </span>
					        @else
					        	<a href="{!!url('/dang-nhap')!!}">Đăng nhập</a>
								<a href="{!!url('/dang-ky')!!}">Đăng ký</a>
					        @endif
							
					</div>
			</div>
			<!--end top header -->
			<!-- menu -->
			<div class="menu-container clearfix">
		        <div class="menu">
		            <ul>
		                <li><a href="{!!url('/')!!}">Trang Chủ</a></li>
		                <li><a href="javascript:void(0)">Danh Mục Sách</a>
		                    <ul>
		                    	@php
		                    		$menu_level_1 = DB::table('categories')->where('parent_id',0)->get();
		                    	@endphp
		                    	@foreach($menu_level_1 as $menu1)
		                        <li>
		                        	<a href="javascript:void(0)">{!!$menu1->name!!}</a>
		                            <ul>
		                            	@php
		                            		$menu_level_2 = DB::table('categories')->where('parent_id',$menu1->id)->get();
		                            	@endphp
		                            	@foreach($menu_level_2 as $menu2)
		                                <li><a href="{!!url('/the-loai',$menu2->alias)!!}">{!!$menu2->name!!}</a></li>
		                                @endforeach
		                            </ul>
		                        </li>
		                        @endforeach
		                    </ul>
		                </li>
		                <li><a href="{!!url('/tin-tuc','gioi-thieu-hpbook')!!}">Giới Thiệu</a></li>
		                <li><a href="#contact">Liên Hệ</a></li>
		                <div class="float-lg-right iconSocial">
		                	<span><a href=""><i class="fab fa-facebook"></i></a></span>
		                	<span><a href=""><i class="fab fa-instagram"></i></a></span>
		                	<span><a href=""><i class="fab fa-youtube"></i></a></span>
		                </div>
		               
		            </ul>
		        </div>
    		</div>
    	

			<!-- end menu -->
		</div>
		<!-- bot header in clude logo, search, cart -->
		<div class="container">
{{-- 				@php
					echo "<pre>";
					    print_r(Cart::getContent());
					echo "</pre>";
				@endphp --}}
			<div class="bot-header">
				<div class="row">
					<div class="col-md-3 d-md-block d-none" id="logo" >
						<a href=""><img src="hpbook/images/logo10.png" alt="nhà sách hpbook"></a>
					</div>
					<div class="col-md-6 text-center mt-md-4" id="search">
						<form action="{!!url('/tim-kiem')!!}" method="GET">

							<input class="border-primary" type="text" name="keySearch" id="keySearch" placeholder="Nhập từ khóa">
							<button type="submit"  id="btnSearch" class="border">Tìm kiếm</button>
						</form>
					</div>
					<div class="col-md-3 text-center mt-md-4 pt-md-2 mt-2 mb-2" id="cart">
						<i class="fas fa-shopping-cart" id="icon"></i>
						<a class=" dropdown-toggle myCartShop" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          Giỏ Hàng @if(!Cart::isEmpty())<span class="badge badge-primary badge-pill noti-icon-badge">{!!Cart::getContent()->count()!!}@endif</span> 
					       </a>
					        <span class="dropdown-menu mt-3 mr-3" id="ProductCart">
					           <a class="dropdown-item mt-2 titleProductCart">Giỏ Hàng</a>
					           <div class="dropdown-divider"></div>
					           @if(Cart::isEmpty())
					           		<span class="ml-4 text-gray-dark small">Giỏ hàng trống</span>
					           @else
					           		@foreach(Cart::getContent() as $item)
							          <a class="dropdown-item " href="{!!url('/chi-tiet',$item->attributes->alias)!!}">
							          	<span class="row ">
							          		<span class="col-2">

							          			<img class="imgProductCart float-left mr-3" src="admin_public/upload/products/{{$item->attributes->image}}" alt="{{$item->attributes->alias}}">
							          		</span>
							          		<span class="col-10">
							          			<span class="nameProductCart">{{$item->name}}</span>
									          	<span class="priceProductCart d-block">{!!number_format($item->price,0,',','.')!!} đ</span>
									          	<span class="qtProductCart d-block text-info">x {{$item->quantity}}</span>
								          		
							          		</span>
							          		
							          	</span>
							          </a>
							          <div class="dropdown-divider"></div>
						          	@endforeach
					           
					          <a class="dropdown-item">
					          	<a href="{!!url('/gio-hang')!!}" class="btn detailProductCart mb-1 ml-4">Xem giỏ hàng</a>
					          	<span class="totalPriceProductCart float-right mr-4 mb-3">{!!number_format(Cart::getTotal(),0,',','.')!!} đ</span>
					          </a>
					          @endif
					        </span>
					</div>
				</div>
			</div>
		</div>
	</header>