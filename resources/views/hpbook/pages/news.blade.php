@extends('hpbook.master')
@section('title')
{!!$news->title!!} - HPBOOK
@endsection
@section('css')
		<!-- style page cart -->
	<link rel="stylesheet" href="hpbook/css/style-news.css">
@endsection
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item breadcrumbText"><a href="{!!url('/')!!}">Trang Chủ</a></li>
				    <li class="breadcrumb-item active breadcrumbText text-capitalize bcActive" aria-current="page">{!!$news->title!!}</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- end breadcrumb -->
	<!-- content -->
	<div class="content">
        <div class="container">
            <div class="wrapper">
                    <h4 class="title text-uppercase">{!!$news->title!!}</h4>
                    <div class="contentNews mt-3 mt-sm-4">
                       {!!$news->content!!}
                    </div>
            </div>
        </div>
    </div>
	<!-- end content -->
@endsection