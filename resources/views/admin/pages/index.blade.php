@extends('admin.master')
@section('title')
Trang Chủ - HPBOOK ADMIN
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

                                    <h4 class="page-title float-left">Thống kê doanh thu tháng {!!$report_now->month!!} năm {!!$report_now->year!!}</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="fi-box float-right"></i>
                                    <h6 class="text-uppercase mb-3">Tổng đơn hàng</h6>
                                    <h4 class="mb-3" data-plugin="counterup">{!!$report_now->countTransaction!!}</h4>
                                    <span class="badge badge-primary">@if(($report_now->countTransaction-$previous_report->countTransaction)/$previous_report->countTransaction*100>0)+@endif {!!number_format(($report_now->countTransaction-$previous_report->countTransaction)/$previous_report->countTransaction*100,0)!!}%</span> <span class="ml-2 vertical-middle">So với tháng trước</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="fi-layers float-right"></i>
                                    <h6 class="text-uppercase mb-3">Doanh thu trong tháng</h6>
                                    <h4 class="mb-3"><span data-plugin="counterup">{!!number_format($report_now->sumTransaction,0)!!}</span> đ</h4>
                                    <span class="badge badge-primary">@if(($report_now->sumTransaction-$previous_report->sumTransaction)/$previous_report->sumTransaction*100>0)+@endif {!!number_format(($report_now->sumTransaction-$previous_report->sumTransaction)/$previous_report->sumTransaction*100,0)!!}%</span> <span class="ml-2 vertical-middle">So với tháng trước</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="fi-tag float-right"></i>
                                    <h6 class="text-uppercase mb-3">Giá trị đơn hàng trung bình</h6>
                                    <h4 class="mb-3"><span data-plugin="counterup">{!!number_format($report_now->avgTransaction,0)!!}</span> đ</h4>
                                    <span class="badge badge-primary">@if(($report_now->avgTransaction-$previous_report->avgTransaction)/$previous_report->avgTransaction*100>0)+@endif {!!number_format(($report_now->avgTransaction-$previous_report->avgTransaction)/$previous_report->avgTransaction*100,0)!!}%</span> <span class="ml-2 vertical-middle">So với tháng trước</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="fi-briefcase float-right"></i>
                                    <h6 class="text-uppercase mb-3">Số sản phẩm bán được</h6>
                                    <h4 class="mb-3" data-plugin="counterup">{!!$report_now->sumQuantity!!}</h4>
                                    <span class="badge badge-primary">@if(($report_now->sumQuantity-$previous_report->sumQuantity)/$previous_report->sumQuantity*100>0)+@endif {!!number_format(($report_now->sumQuantity-$previous_report->sumQuantity)/$previous_report->sumQuantity*100,0)!!}%</span> <span class="ml-2 vertical-middle">So với tháng trước</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-12">
                                    <div class="card-box table-responsive">
                                       
                                        <h4 class="m-t-0 header-title mb-4"><b>Thống kê chi tiết</b></h4>
                                        <p class="font-14">
                                                Tính đến ngày @php
                                                $date = date("d/m/Y",strtotime($nowString));
                                                echo $date;
                                            @endphp
                                            </p>
                                        <table id="datatable" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên Sách</th>
                                                <th>Số Lượng Bán Ra</th>
                                                <th>Giá</th>
                                                <th>Thành Tiền</th>
                                                <th>Ngày</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=0;
                                            @endphp

                                            @foreach($transaction as $value)

                                                @foreach($value->products as $product)
                                                    @php
                                                        $i=$i+1;
                                                        $pro_tran = DB::table('product_transaction')->where([['product_id',$product->id],['transaction_id',$value->id]])->first();
  
                                                    @endphp
                                                    <tr>

                                                        <td>{!!$i!!}</td>
             
                                                        <td>{!!$product->name!!}</td>
                     
                                                        <td>{!!$pro_tran->quantity!!}</td>
                           
                                                        <td>{!!number_format($product->price-$product->price*$product->discount/100,0,',','.')!!} đ</td>
                                   
                                                        <td>{!!number_format($pro_tran->amount_total,0,',','.')!!} đ</td>
                                        
                                                        <td>@php
                                                                $date = date("d/m/Y",strtotime($value->created_at));
                                                                echo $date;
                                                            @endphp</td>
                                                    </tr>
                                                @endforeach
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