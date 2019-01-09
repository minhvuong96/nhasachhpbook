@extends('hpbook.master')
@section('title')
Đăng Ký Tài Khoản - HPBOOK
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Đăng Ký Tài Khoản</li>
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
				<div class="col-3 d-md-block d-none"></div>
				<div class="col-sm-6 register">
					@include('hpbook.blocks.message')
					<h4 id="titleRegister">Đăng ký tài khoản</h4>
					<form action="{!!url('/dang-ky')!!}" method="post">
						<input type="hidden" name="_token" value="{!!csrf_token()!!}">
						<div class="form-group">
							<label for="name">Họ và tên:</label>
						    <input type="text" name="name" class="form-control" id="name"  required="required">
						</div>
						<div class="form-group">
							<label for="email">email:</label>
						    <input type="email" name="email" class="form-control" id="email"  required="required">
						</div>
						<div class="form-group">
							<label for="password">mật khẩu:</label>
							<input type="password" name="password" class="form-control" id="password" required="required">
						</div>
						<div class="form-group">
							<label for="confirm-password">xác nhận lại mật khẩu:</label>
							<input type="password" name="confirm-password" class="form-control" id="confirm-password" required="required">
						</div>
						{{-- captcha --}}
				        <div class="form-group">
				            <div class="captcha">
				               <span>{!! captcha_img() !!}</span>
				               <button type="button" class="btn btn-success"><i class="fas fa-sync-alt" id="refresh"></i></button>
				            </div>
				        </div>
				        <div class="form-group">
				             <input id="captcha" type="text" class="form-control w-25" placeholder="Nhập Captcha" name="captcha">
				         </div>
				        {{-- end captcha --}}
						<button type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister">đăng ký</button>
		
					</form>
					
				</div>
				<div class="col-3 d-md-block d-none"></div>
			</div>
		</div>
	</div>
	<!-- end content -->
@endsection
@section('script')
	<!-- js register -->
	<script src="hpbook/js/confirm-password.js"></script>
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