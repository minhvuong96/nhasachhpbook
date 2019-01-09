@extends('hpbook.master')
@section('title')
Khôi Phục Mật Khẩu - HPBOOK
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item active breadcrumbText bcActive" aria-current="page">Khôi Phục Mật Khẩu</li>
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
					<h4 id="titleRegister">khôi phục mật khẩu</h4>
					<form action="{!!url('/khoi-phuc-mat-khau')!!}" method="post">
						<input type="hidden" name="_token" value="{!!csrf_token()!!}">
						<div class="form-group">
							<label for="old-password">Mã khôi phục</label>
							<input type="text" name="remember_token" class="form-control" id="remember_token"
							required="required">
						</div>
						<div class="form-group">
							<label for="password">mật khẩu mới:</label>
							<input type="password" name="password" class="form-control" id="password"
							required="required">
						</div>
						<div class="form-group">
							<label for="confirm-password">xác nhận lại mật khẩu:</label>
							<input type="password" name="confirm-password" class="form-control" id="confirm-password" required="required">
						</div>
						<button type="submit" class="btn btn-primary" name="btnChange" id="btnChange">Lưu</button>
		
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
@endsection