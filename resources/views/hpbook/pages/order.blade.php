@extends('hpbook.master')
@section('title')
Giỏ Hàng - HPBOOK
@endsection
@section('css')
		<!-- style page order -->
	<link rel="stylesheet" href="hpbook/css/order.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/gio-hang')!!}">Giỏ Hàng</a></li>
				    <li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Thanh Toán</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="container">
		@include('hpbook.blocks.message')
	</div>
	@if(!Cart::getContent()->count()==0)
	<div class="content">
		<div class="container">
			
			<form action="{!!url('/dat-hang')!!}" method="post" onsubmit="return checkPhone();">
				@csrf
				<div class="row">
					
					<div class="col-sm-6 infoUser">
						<h4>Thông tin khách hàng</h4>
						<div class="content-info">
							<div class="form-group">
							    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required="required" readonly="readonly" value="{!!old('email',Auth::user()->email)!!}">
							 </div>
							 <div class="form-group">
							    <input type="text" name="name" class="form-control" id="name" placeholder="Họ và tên" required="required" value="{!!old('name',Auth::user()->name)!!}">
							 </div>
							 <div class="form-group">
							    <input type="text" name="phone" class="form-control" id="phone" placeholder="Số điện thoại" required="required" maxlength="11" value="{!!old('phone',isset(Auth::user()->phone) ? Auth::user()->phone :null)!!}">
							    <p class="text-danger small" id="msgPhone"></p>
							 </div>
							 <div class="form-group">
							    <textarea name="address" placeholder="Địa chỉ đầy đủ" class="form-control" id="address" rows="3" required="required" >{!!old('address',isset(Auth::user()->address) ? Auth::user()->address :null)!!}</textarea>
							 </div>
							 <div class="form-group">
							    <textarea name="other_address" placeholder="Địa chỉ nhận hàng khác (nếu có)" class="form-control" id="other_address" rows="3" >{!!old('other_address',isset(Auth::user()->other_address) ? Auth::user()->other_address :null)!!}</textarea>
							 </div>
							 <div class="form-group">
							    <textarea placeholder="Ghi chú của khách hàng" class="form-control" id="note" rows="3" name="note"></textarea>
							 </div>
						</div>
					</div>
					<div class="col-sm-6 mt-3 mt-sm-0 payment-shipping">

						<div class="payment-method">
							<h4>Phương thức thanh toán</h4>
							<div class="selectMethod">
								{{-- <div class="form-check myRadio">
								  <input class="form-check-input" type="radio" name="radioPayment" id="inlineRadio1" value="1">
								  <label class="form-check-label" for="inlineRadio1">Thanh toán qua Paypal</label>
								</div> --}}
								<div class="form-check myRadio">
								  <input class="form-check-input" type="radio" name="radioPayment" id="inlineRadio2" value="2">
								  <label class="form-check-label" for="inlineRadio2">Thanh toán qua chuyển khoản (Miễn phí vận chuyển)</label>
								</div>
								<div class="form-check myRadio">
								  <input class="form-check-input" type="radio" name="radioPayment" id="inlineRadio3" value="3" checked="checked">
								  <label class="form-check-label" for="inlineRadio3">Thanh toán tiền mặt khi nhận hàng (COD)</label>
								</div>
							</div>
						</div>
						<!-- end payment method -->
					</div>
					<!-- end payment shipping -->
				</div>
				<!-- end row -->
				<div class="row mt-3 mt-sm-4">
					<div class="col-sm-6 checkOrder">
						<h4>Kiểm tra lại đơn hàng</h4>
						<div class="content-check">
							<div class="table-responsive">
								<table>
									<tr>
										<th>Tên Sách</th>
										<th>Số Lượng</th> 
										<th>Thành Tiền</th>
									</tr>
									@foreach(Cart::getContent() as $item)
									<tr>
										<td>
											<a href="{!!url('/chi-tiet',$item->attributes->alias)!!}">{!!$item->name!!}</a>
										</td>
										<td>
											<span>{!!$item->quantity!!}</span>
										</td>
										<td>
											<span>{!!number_format($item->price*$item->quantity,0,',','.')!!} đ</span>
										</td>
									</tr>
									@endforeach
								</table>
							</div>
							<!-- end table -->
							<hr>
							<div class="form-group discountCode">
							    <input type="text" name="code" class="form-control d-inline-block w-50" id="code" placeholder="Mã giảm giá">
							    <a id="apply" href="javascript:void(0)" class="btn btn-success float-right">Áp dụng</a>
							    <p class="text-danger small mt-2" id="message"></p>
							    <input type="hidden" name="amount_discount" class="form-control d-inline-block w-50" id="amount_discount" value="0">
							</div>
							<!-- end discount code -->
							<hr>
							<div class="summaryPrice">
								<div class="summaryLine">
									<label for="">Tạm tính</label>
									<span class="float-right">{!!number_format(Cart::getTotal(),0,',','.')!!} đ</span>
								</div>
								<div class="summaryLine">
									<label for="">Phí vận chuyển</label>
									<span class="float-right">đang tính</span>
								</div>
								<div class="summaryLine">
									<label for="">Giảm giá</label>
									<span id="spanDiscount" class="float-right">0 đ</span>
								</div>
								<hr>
								<div class="summaryLine">
									<label id="labelSummaryTotal" for="">Tổng cộng</label>
									<span class="float-right summaryTotal" id="spanAmounttotal">{!!number_format(Cart::getTotal(),0,',','.')!!} đ</span>
									<input type="hidden" name="amount_total" class="form-control d-inline-block w-50" id="amount_total" value="{!!Cart::getTotal()!!}">
								</div>
							</div>
							<!-- end price -->
							{{-- captcha --}}
					        <div class="form-group">
					            <div class="captcha">
					               <span>{!! captcha_img() !!}</span>
					               <button type="button" class="btn btn-success"><i class="fas fa-sync-alt" id="refresh"></i></button>
					            </div>
					        </div>
					        <div class="form-group">
					             <input id="captcha" type="text" class="form-control w-50 small" placeholder="Nhập Captcha" name="captcha">
					         </div>
					        {{-- end captcha --}}
							<div class="mt-3 mb-3">
								<a href="{!!url('/gio-hang')!!}" id="returnCart" class="mb-3"><i class="fas fa-angle-double-left"></i> Quay về giỏ hàng</a>
								
								<button type="submit" id="btnOrder" value="submit" name="btnOrder" class="btn btn-success float-right mb-3">Đặt hàng</button>
							</div>	
						</div>
						<!-- end content check -->
					</div>
					<!-- end check order -->
				</div>
			</form>
		</div>
		<!-- end container -->
	</div>
	@endif
	<!-- end content -->
@endsection
@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#apply').click(function(event) {
				var code = $('#code').val();
				var amount_total = $('#amount_total').val();
				var value = $('#amount_discount').val();
				$.ajax({
					url: 'dat-hang',
					type: 'POST',
					data: {code: code, _token: '{{csrf_token()}}', amount_total: amount_total, amount_discount:value},
				})
				.done(function(data) {
					$('#amount_discount').val(data[0]);
					$('#spanDiscount').html(data[1]);
					$('#amount_total').val(data[2]);
					$('#spanAmounttotal').html(data[3]);
					$('#message').html(data[4]);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
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
	<script type="text/javascript">
		
	</script>
@endsection