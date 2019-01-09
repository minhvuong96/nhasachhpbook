@extends('hpbook.master')
@section('title')
Đặt Hàng Thành Công - HPBOOK
@endsection
@section('css')
		<!-- style page cart -->
	<link rel="stylesheet" href="hpbook/css/style-confirm.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
		<div class="container">
			
				<div class="bg-white text-center wrapperConfirmed">
					<h4 id="titleConfirmed"><i class="fas fa-bookmark mr-3"></i>Cảm ơn bạn đã mua sách tại HPBOOK</h4>
					<div id="contentConfirmed ">
						<p id="line1">Đơn hàng của bạn đã được đặt thành công và đang chờ được xác nhận</p>
						<p id="line2">Mã đơn hàng của bạn là: #{!!$transaction['id']!!}  <a href="{!!url('/chi-tiet-don-hang',$transaction['id'])!!}" class="text-uppercase">theo dõi đơn hàng</a></p>
						<p id="line3">Bạn có thể quản lý và kiểm tra đơn hàng tại <a href="{!!url('/don-hang-cua-toi')!!}">Đơn hàng của tôi</a></p>
						<p id="line4">Đơn hàng của bạn sẽ được giao trong 3-7 ngày làm việc</p>
						<p id="line5">Bạn KHÔNG phải trả bất kì khoản TIỀN ĐẶT CỌC nào. Vui lòng kiểm tra kỹ MÃ ĐƠN HÀNG và hình thức sản phẩm trước khi thanh toán, nhận hàng. Để được hỗ trợ, vui lòng <a href="">liên hệ</a></p>
					</div>
					<div class="bg-light" id="detailOrderConfirmed">
						<div id="titleDetailOrderConfirmed">
							Chi tiết đơn hàng
						</div>
						<div class="amount">
							<span>Tạm tính ({!!count($transaction['products'])!!} sản phẩm)</span>
							<span class="float-right">{!!number_format($transaction['amount_temporary'],0,',','.')!!} đ</span>
						</div>
						<div class="amount">
							<span>Phí giao hàng</span>
							<span class="float-right">đang tính</span>
						</div>
						<div class="amount">
							<span>Giảm giá</span>
							<span class="float-right">{!!number_format($transaction['amount_discount'],0,',','.')!!} đ</span>
						</div>

						<br>
						<div class="amount amountTotal">
							<span>Tổng cộng</span>
							<span class="float-right">{!!number_format($transaction['amount_total'],0,',','.')!!} đ</span>
						</div>
					</div>
					<a href="" class="btn btn-primary">TIẾP TỤC MUA SÁCH</a>
				</div>
			
		</div>
	</div>
	<!-- end content -->
@endsection