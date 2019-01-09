<!DOCTYPE html>
<html lang="en">
<head>
	<title>404</title>
	<meta charset="UTF-8">
	<base href="{!!asset('')!!}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="stylesheet" href="hpbook/bootstrap/css/bootstrap.min.css">
	{{-- <link rel="stylesheet" href="hpbook/css/style.css"> --}}
	<link rel="stylesheet" href="hpbook/fontawesome-free-5.3.1-web/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=vietnamese" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css"> --}}
    <link rel="stylesheet" href="hpbook/css/style-404.css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>

</head>
<body class="text-center">
	<i class="far fa-dizzy"></i>
    <h3 class="title text-uppercase">404</h4>
    <h4 class="mt-4">KHÔNG TÌM THẤY TRANG</h4>
    <div class="text-uppercase mt-4">
        trang bạn yêu cầu không thể được hiển thị. Trang không tồn tại hoặc đã bị xóa hoặc do lỗi tạm thời của máy chủ.
    </div>
    <a href="{!!redirect()->getUrlGenerator()->previous()!!}" class="mt-4 d-block">QUAY TRỞ VỀ</a>
</body>
</html>