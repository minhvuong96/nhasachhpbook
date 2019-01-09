@extends('hpbook.master')
@section('title')
Đăng Nhập - HPBOOK
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Đăng Nhập</li>
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
				<div class="col-sm-6 login">
					@include('hpbook.blocks.message')
					<h4 id="titleLogin">Đăng nhập</h4>
					<form action="{!!url('/dang-nhap')!!}" method="post">
						<input type="hidden" name="_token" value="{!!csrf_token()!!}">
						<div class="form-group">
							<label for="email">email:</label>
						    <input type="email" name="email" class="form-control" id="email"  required="required">
						</div>
						<div class="form-group">
							<label for="password">mật khẩu:</label>
							<input type="password" name="password" class="form-control" id="password"
							required="required">
						</div>

						<button type="submit" class="btn btn-primary" name="btnLogin" id="btn-login">đăng nhập</button>
						<a href="{!!url('/quen-mat-khau')!!}" id="forgot-password" class="float-right">Quên mật khẩu?</a>
						<div class="clearfix">
							<h4 class="float-left"><a href="{!!url('/dang-ky')!!}">Người dùng mới? Đăng ký tài khoản</a></h4>
							<div class="float-right">
								<a href="{{ url('/dang-nhap/facebook') }}" id="connectFb" ><i class="fab fa-facebook"></i></a>
								<a href="{{ url('/dang-nhap/google') }}" id="connectGg" ><i class="fab fa-google-plus-g"></i></a>
							</div>
						</div>
					</form>
					
				</div>
				<div class="col-3 d-md-block d-none"></div>
			</div>
		</div>
	</div>
	<!-- end content -->
@endsection