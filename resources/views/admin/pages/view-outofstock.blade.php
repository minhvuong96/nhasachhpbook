@extends('admin.master')
@section('title')
Hết Hàng- HPBOOK ADMIN
@endsection
@section('css')
<!-- DataTables -->
        <link href="admin_public/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="admin_public/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="admin_public/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <ol class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                        <li class="breadcrumb-item active">Quản Lý Kho</li>
                        <li class="breadcrumb-item active">Hết Hàng</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    @include('admin.blocks.message')
                    <h4 class="m-t-0 header-title mb-4"><b>Danh Sách Sách</b></h4>
                    
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh Mục</th>
                            <th>Giá</th>
                            <th>Giảm giá</th>
                            <th>Hình ảnh</th>
                            <th>Năm xuất bản</th>
                            <th>Nhà xuất bản</th>
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product as $item)
                        <tr>
                            <td>{!!$item['id']!!}</td>
                            <td>{!!$item['name']!!}</td>
                            <td>
                                @php
                                    $cate = DB::table('categories')->where('id',$item['cate_id'])->first();
                                    echo $cate->name;
                                @endphp
                            </td>
                            <td>{!! number_format($item['price']) !!} đ</td>
                            <td>{!!$item['discount']!!}%</td>
                            <td><img style="width:75px; height:100px;" src="admin_public/upload/products/{!!$item['image']!!}" alt="{!!$item['alias']!!}"></td>
                            <td>{!!$item['publish_year']!!}</td>
                            <td>
                                @php
                                    $publisher = DB::table('publishers')->where('id',$item['publisher_id'])->first();
                                    echo $publisher->name;
                                @endphp
                            </td>
                            <td>
                                @php
                                    $p = DB::table('products')->where('products.id',$item['id'])
                                    ->join('author_product', 'products.id', '=', 'author_product.product_id')
                                    ->join('authors', 'authors.id', '=', 'author_product.author_id')
                                    ->select('authors.name')
                                    ->get()->toArray();
                                    foreach($p as $author){
                                        echo "- ".$author->name."</br>";
                                    }
                                @endphp
                            </td>
                            @if($item['quantity']==0)
                                <td>Hết hàng</td>
                            @else
                                <td>Còn hàng ({!!$item['quantity']!!} quyển)</td>
                            @endif
                            <td>
                                <span class="action">
                                    <a class="iconViewCate text-success" href="{!!url('/admin/edit-product',$item['id'])!!}" data-toggle="tooltip" data-placement="top" title="Sửa sản phẩm"><i class="fas fa-edit"></i></a>                 
                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="iconViewCate text-danger" href="{!!url('/admin/delete-product',$item['id'])!!}" data-toggle="tooltip" data-placement="top" title="Xóa sản phẩm"><i class="fas fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
@endsection
@section('script')
	<!-- Required datatable js -->
        <script src="admin_public/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="admin_public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="admin_public/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="admin_public/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="admin_public/plugins/datatables/jszip.min.js"></script>
        <script src="admin_public/plugins/datatables/pdfmake.min.js"></script>
        <script src="admin_public/plugins/datatables/vfs_fonts.js"></script>
        <script src="admin_public/plugins/datatables/buttons.html5.min.js"></script>
        <script src="admin_public/plugins/datatables/buttons.print.min.js"></script>
        <!-- Responsive examples -->
        <script src="admin_public/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="admin_public/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
@endsection