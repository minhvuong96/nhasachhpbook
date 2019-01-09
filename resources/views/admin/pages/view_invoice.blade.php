@extends('admin.master')
@section('title')
Hóa Đơn Thanh Toán - HPBOOK 
@endsection
@section('css')
@endsection
@section('content')
<div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Hóa Đơn</h4>

                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                        <li class="breadcrumb-item"><a href="{!!url('/admin/approval-order',$transaction->id)!!}">Chi Tiết Đơn Hàng</a></li>
                                        <li class="breadcrumb-item active">Hóa Đơn</li>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <img src="assets/images/logo_dark.png" alt="" height="20">
                                        </div>
                                        <div class="pull-right">
                                            <h4 class="m-0 d-print-none">Hóa Đơn</h4>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="pull-left mt-3">
                                                <p><b>Xin chào, {!!$transaction->user->name!!}</b></p>
                                                <p class="text-muted">Cảm ơn bạn đã tiếp tục mua sách của HPBOOK. Chúng tôi hứa hẹn sẽ cung cấp những sản phẩm sách chất lượng cao cho bạn cũng như dịch vụ chăm sóc khách hàng tốt nhất cho mọi giao dịch.</p>
                                            </div>

                                        </div><!-- end col -->
                                        <div class="col-4 offset-2">
                                            <div class="mt-3 pull-right">
                                                <p class="m-b-10"><strong>Ngày Đặt Hàng: </strong> @php
                                                        $dateOrder = date("d/m/Y",strtotime($transaction->created_at));
                                                        echo $dateOrder;
                                                    @endphp</p>
                                                <p class="m-b-10"><strong>Mã Đơn Hàng: </strong> #{!!$transaction->id!!}</p>
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6>Địa Chỉ Khách Hàng</h6>

                                            <address class="line-h-24">
                                                {!!$transaction->user->address!!}<br>
                                                <abbr >Điện thoại:</abbr> {!!$transaction->user->phone!!}
                                            </address>

                                        </div>

                                        <div class="col-6">
                                            <h6>Địa Chỉ Giao Hàng</h6>

                                            <address class="line-h-24">
                                                @if(isset($transaction->user->other_adress))
                                                    {!!$transaction->user->other_address!!}<br>
                                                    
                                                @else
                                                    {!!$transaction->user->address!!}<br>
                                                @endif
                                                <abbr >Điện thoại:</abbr> {!!$transaction->user->phone!!}
                                            </address>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4">
                                                    <thead>
                                                    <tr><th>#</th>
                                                        <th>Tên Sách</th>
                                                        <th>Số Lượng</th>
                                                        <th>Đơn Giá</th>
                                                        <th class="text-right">Thành Tiền</th>
                                                    </tr></thead>
                                                    <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @foreach($transaction->products as $product)
                                                    @php
                                                        $i = $i+1;
                                                        $pro_tran = DB::table('product_transaction')->where([['transaction_id',$transaction->id],['product_id',$product->id]])->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{!!$i!!}</td>
                                                        <td>
                                                            <b>{!!$product->name!!}</b>
                                                        </td>
                                                        <td>{!!$pro_tran->quantity!!}</td>
                                                        <td>{!!number_format($product->price - $product->price*$product->discount/100,0,',','.')!!} đ</td>
                                                        <td class="text-right">{!!number_format($pro_tran->amount_total,0,',','.')!!} đ</td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            {{-- <div class="clearfix pt-5">
                                                <h6 class="text-muted">Notes:</h6>

                                                <small>
                                                    All accounts are to be paid within 7 days from receipt of
                                                    invoice. To be paid by cheque or credit card or direct payment
                                                    online. If account is not paid within 7 days the credits details
                                                    supplied as confirmation of work undertaken will be charged the
                                                    agreed quoted fee noted above.
                                                </small>
                                            </div> --}}

                                        </div>
                                        <div class="col-6">
                                            <div class="float-right">
                                                <p><b>Tạm Tính:</b> {!!number_format($transaction->amount_temporary,0,',','.')!!} đ</p>
                                                <p><b>Phí vận chuyển:</b> {!!number_format($transaction->amount_shipping,0,',','.')!!} đ</p>
                                                <p><b>Giảm giá:</b> {!!number_format($transaction->amount_discount,0,',','.')!!} đ</p>
                                                <h3>{!!number_format($transaction->amount_total,0,',','.')!!} đ</h3>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="hidden-print mt-4 mb-4">
                                        <div class="text-right">
                                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> In</a>
                                            <a href="{!!url('/admin/approval-order',$transaction->id)!!}" class="btn btn-info waves-effect waves-light">Trở Lại</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
@endsection
@section('script')
@endsection