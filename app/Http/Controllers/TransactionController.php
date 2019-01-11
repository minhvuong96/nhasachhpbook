<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use App\Product;
use Auth;
use Cart;
use DB;
use Carbon\Carbon;
use App\Coupon;
use Validator;

class TransactionController extends Controller
{
    //
    //Đặt hàng
    public function order(Request $request)
    {
        if (Cart::getContent()->count() == 0) {
            return redirect()->back();
        } else {
            if ($request->isMethod('post')) {
                if (isset($request->btnOrder)) {
                    //lưu giao dịch
                    $v = Validator::make($request->all(), [

                        'captcha' => 'required|captcha',
                        'phone' => 'required|regex:/[0-9]{11}/'
                    ],
                        [

                            'captcha.required' => 'Chưa nhập mã xác nhận',
                            'captcha.captcha' => 'Sai mã xác nhận',
                            'phone.regex' => 'Sai định dạng số điện thoại',
                        ]
                    );
                    if ($v->fails()) {
                        return redirect()->back()->withErrors($v->errors());
                    }
                    $transaction = new Transaction();
                    $transaction->user_id = Auth::user()->id;
                    $transaction->amount_temporary = Cart::getTotal();
                    $transaction->amount_shipping = 0;
                    $transaction->amount_discount = $request->amount_discount;
                    //$request->amount_total đã bao gồm cả discount
                    $transaction->amount_total = $request->amount_total + $transaction->amount_shipping;
                    $transaction->payment = $request->radioPayment;
                    $transaction->status = 1;//Chờ xác nhận
                    if (isset($request->note)) {
                        $transaction->note = $request->note;
                    }
                    $transaction->save();
                    //lưu thông tin khách hàng
                    $user = User::find(Auth::user()->id);
                    $user->name = $request->name;
                    $user->phone = $request->phone;
                    $user->address = $request->address;
                    if (isset($request->other_address)) {
                        $user->other_address = $request->other_address;
                    }
                    $user->save();
                    //Lưu từng đơn hàng
                    $cart = Cart::getContent();
                    // $id = array();
                    // $quantity = array();
                    $order = Transaction::find($transaction->id);
                    foreach ($cart as $value) {
                        # code...
                        // array_push($id, $value->id);
                        // array_push($quantity,$value->quantity);
                        $order->products()->attach($value->id, ['quantity' => $value->quantity, 'amount_total' => $value->quantity * $value->price]);
                    }
                    Cart::clear();
                    return redirect()->route('xacnhan', ['id' => $transaction->id])->with(['order' => 'success']);
                }
            }
            if ($request->ajax()) {
                $message = "Không thể sử dụng mã này.";
                $value = $request->amount_discount;
                $data = number_format($request->amount_discount, 0, ',', '.') . " đ";
                if ($request->amount_total == Cart::getTotal()) {
                    $now = Carbon::now();
                    // echo $now->format('Y-m-d');die;
                    $coupon = Coupon::where('code', $request->code)->where('expiry_date', '>=', $now->format('Y-m-d'))->first();
                    if (!empty($coupon)) {
                        $value = $coupon->discount * $request->amount_total;
                        $data = number_format($coupon->discount * $request->amount_total, 0, ',', '.') . " đ";
                        $total = $request->amount_total - $value;
                        $data2 = number_format($total, 0, ',', '.') . " đ";
                        return [$value, $data, $total, $data2, ""];
                    } else {
                        return [$value, $data, $request->amount_total, number_format($request->amount_total, 0, ',', '.') . " đ", $message];
                    }
                } else {
                    $message = "Mỗi đơn hàng chỉ sử dụng được một mã.";
                    return [$value, $data, $request->amount_total, number_format($request->amount_total, 0, ',', '.') . " đ", $message];
                }
            }

            return view('hpbook.pages.order');
        }
    }

    public function confirmOrder($id)
    {
        if (session()->has('order')) {
            $transaction = Transaction::where('id', $id)->with('products')->first()->toArray();
            if (!empty($transaction)) {
                return view('hpbook.pages.confirm-order', compact('transaction'));
            } else {
                return redirect('/don-hang-cua-toi');
            }

        } else {
            return redirect('/don-hang-cua-toi');
        }
    }

    //Quản lý đơn hàng
    public function myOrder()
    {
        $transaction = User::find(Auth::user()->id)->transactions->load('products')->sortByDesc('created_at');
        return view('hpbook.pages.myOrder', compact('transaction'));
    }

    //Chi tiết đơn hàng
    public function detailOrder($id)
    {
        $transaction = Transaction::find($id);
        if (!empty($transaction)) {
            $transaction = $transaction->load('products');
            return view('hpbook.pages.detail-order', compact('transaction'));
        } else {
            return redirect('/don-hang-cua-toi');
        }
    }

    //hủy đơn hàng
    public function cancellationOrder($id)
    {
        $transaction = Transaction::find($id);
        if (!empty($transaction)) {
            $transaction = $transaction->load('products');
            return view('hpbook.pages.cancellation-order', compact('transaction'));
        } else {
            return redirect('/don-hang-cua-toi');
        }
    }

    //Xác nhận hủy đơn
    public function confirmCancellation(Request $request)
    {
        if ($request->isMethod('post')) {
            $transaction = Transaction::find($request->id);
            if ($transaction->status != 5) {
                $transaction->status = 5;
                $transaction->save();
                $pro_tran = DB::table('product_transaction')->where('transaction_id', $request->id)->get();
                foreach ($pro_tran as $item) {
                    $product = Product::find($item->product_id);
                    $product->quantity = $product->quantity + $item->quantity;
                    $product->count_buy = $product->count_buy - $item->quantity;
                    $product->save();
                    //print_r($p);
                }
                $transaction->load('products');
                return view('hpbook.pages.confirm-cancellation', compact('transaction'));
            } else {
                return redirect()->back()->with(['flash_message' => 'danger', 'message' => 'Đơn hàng đã bị hủy trước đó']);
            }
        } else {
            return redirect()->back();
        }

    }

    //Đơn hàng mới của đơn hàng trả trước
    public function newOrder()
    {
        $transaction = Transaction::where([
            ['status', '=', '1'],
            ['payment', '<>', '3']
        ])->with('user')->get();
        return view('admin.pages.view-newOrder', compact('transaction'));
    }
    //Đơn hàng đã nhận của đơn hàng trả trước
    public function orderReceived(){
        $transaction = Transaction::where([
            ['status', '=', '2'],
            ['payment', '<>', '3'],
            ['admin_id','=',auth()->id()]
        ])->with('user')->get();
        return view('admin.pages.view-orderReceived', compact('transaction'));
    }
    //Đơn hàng đã vận chuyển của đơn hàng trả sau
    public function orderDelivered(){
        $transaction = Transaction::where([
            ['status', '=', '3'],
            ['payment', '<>', '3'],
            ['admin_id','=',auth()->id()]
        ])->with('user')->get();
        return view('admin.pages.view-orderDelivered', compact('transaction'));
    }
    //Danh sách đơn hàng trả trước đã giao
    public function viewOrder()
    {
        $transaction = Transaction::where([
            ['status', '=', '4'],// Đơn hàng không bị hủy
            ['payment', '<>', '3']//Hình thức thanh toán không phải COD
        ])->with('user')->get();
        return view('admin.pages.view-order', compact('transaction'));
    }


    //Đơn hàng mới của đơn hàng trả sau
    public function newOrderCOD()
    {
        $transaction = Transaction::where([
            ['status', '=', '1'],
            ['payment', '=', '3']
        ])->with('user')->get();
        return view('admin.pages.view-newOrderCOD', compact('transaction'));
    }
    //Đơn hàng đã nhận của đơn hàng trả sau
    public function orderReceivedCOD(){
        $transaction = Transaction::where([
            ['status', '=', '2'],
            ['payment', '=', '3'],
            ['admin_id','=',auth()->id()]
        ])->with('user')->get();
        return view('admin.pages.view-orderReceivedCOD', compact('transaction'));
    }
    //Đơn hàng đã vận chuyển của đơn hàng trả sau
    public function orderDeliveredCOD(){
        $transaction = Transaction::where([
            ['status', '=', '3'],
            ['payment', '=', '3'],
            ['admin_id','=',auth()->id()]
        ])->with('user')->get();
        return view('admin.pages.view-orderDeliveredCOD', compact('transaction'));
    }
    //Danh sách đơn hàng trả sau đã giao
    public function viewOrderCOD()
    {
        $transaction = Transaction::where([
            ['status', '=', '4'],
            ['payment', '=', '3']
        ])->with('user')->get();
        return view('admin.pages.view-orderCOD', compact('transaction'));
    }

    //Duyệt Đơn Hàng
    public function approvalOrder($id)
    {
        $transaction = Transaction::find($id);
        if (!empty($transaction)) {
            if ($transaction->admin_id == "") {
                $transaction->admin_name = Auth::user()->name;
                $transaction->admin_id = Auth::user()->id;
                $transaction->save();
                $transaction = $transaction->load('products', 'user');
                return view('admin.pages.edit_newOrder', compact('transaction'));
            } elseif ($transaction->admin_id == Auth::user()->id) {
                $transaction = $transaction->load('products', 'user');
                return view('admin.pages.edit_newOrder', compact('transaction'));
            } else {
                return redirect()->back()->with(['flash_message' => 'danger', 'message' => 'Đơn hàng đã được tiếp nhận.']);
            }
        } else {
            return redirect()->back();
        }

    }

    //Đơn hàng bị hủy
    public function canOrder()
    {
        $transaction = Transaction::where('status', 5)->with('user')->get();
        return view('admin.pages.view-cancellationOrder', compact('transaction'));
    }

    //Xóa đơn hàng
    public function deleteOrder($id)
    {
        $transaction = Transaction::find($id)->delete();
        if (!empty($transaction)) {
            return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Xóa đơn hàng thành công']);
        } else {
            return redirect()->back();
        }
    }

    //Sửa đơn hàng
    public function editOrder(Request $request)
    {
        if ($request->method('post')) {
            if (isset($request->btnReload)) {
                $arr = array_combine($request->product_id, $request->quantity);
                foreach ($arr as $key => $value) {
                    $pro_tran = DB::table('product_transaction')->where('product_id', $key)->first();
                    $product = Product::find($key);
                    $product->quantity = $product->quantity + $pro_tran->quantity - $value;
                    $product->save();
                    //$pro_tran->quantity = $value;
                    //$pro_tran->amount_total = ($product->price - $product->price*$product->discount/100)*$value;
                    $pro_tran = DB::table('product_transaction')->where('product_id', $key)->update(
                        ['quantity' => $value,
                            'amount_total' => ($product->price - $product->price * $product->discount / 100) * $value
                        ]
                    );
                }
                $transaction = Transaction::find($request->transaction_id);
                $pro_tran = DB::table('product_transaction')->where('transaction_id', $request->transaction_id)->get();
                $amount_temporary = 0;
                foreach ($pro_tran as $value) {
                    $amount_temporary = $amount_temporary + $value->amount_total;
                }
                if (isset($request->pay_status)) {
                    $transaction->pay_status = $request->pay_status;
                }
                $transaction->amount_temporary = $amount_temporary;
                $transaction->amount_shipping = $request->amount_shipping;
                $transaction->amount_total = $amount_temporary - $transaction->amount_discount + $request->amount_shipping;
                $transaction->save();
                return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Cập nhật đơn hàng thành công']);;
            } elseif (isset($request->btnApproval)) {
                $transaction = Transaction::find($request->transaction_id);
                $transaction->status = $transaction->status + 1;
                if ($transaction->status == 4) {
                    $transaction->pay_status = 1;
                }
                if (isset($request->pay_status)) {
                    $transaction->pay_status = $request->pay_status;
                }
                $transaction->save();
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    //hủy đơn hàng cho admin
    public function cancellation($id)
    {
        $transaction = Transaction::find($id);
        if (!empty($transaction)) {
            if ($transaction->status != 5) {
                $transaction->status = 5;
                $transaction->save();
                $pro_tran = DB::table('product_transaction')->where('transaction_id', $id)->get();
                foreach ($pro_tran as $item) {
                    $product = Product::find($item->product_id);
                    $product->quantity = $product->quantity + $item->quantity;
                    $product->count_buy = $product->count_buy - $item->quantity;
                    $product->save();
                    //print_r($p);
                }
                return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Hủy đơn hàng thành công']);
            } else {
                return redirect()->back()->with(['flash_message' => 'danger', 'message' => 'Đơn hàng đã bị hủy trước đó']);
            }
        } else {
            return redirect()->back();
        }

    }

    //in hóa đơn
    public function printInvoice($id)
    {
        $transaction = Transaction::where('id', $id)->with('user', 'products')->first();
        return view('admin.pages.view_invoice', compact('transaction'));
    }
}
