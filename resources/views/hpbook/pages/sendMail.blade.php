@extends('hpbook.master')
@section('title')
Quên Mật Khẩu - HPBOOK
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Quên Mật Khẩu</li>
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
					<h5 style="font-size: 1em;" id="titleLogin">Gửi nội dung khôi phục mật khẩu</h5>
					<form action="{!!url('/quen-mat-khau')!!}" method="post">
						<input type="hidden" name="_token" value="{!!csrf_token()!!}">
						<div class="form-group">
							<label for="email">email tài khoản:</label>
						    <input type="email" name="email" class="form-control" id="email"  required="required">
						</div>
						<button type="submit" class="btn btn-primary" name="btnSend" id="btnSend">Gửi</button>
					</form>
					
				</div>
				<div class="col-3 d-md-block d-none"></div>
			</div>
		</div>
	</div>
	<!-- end content -->
@endsection