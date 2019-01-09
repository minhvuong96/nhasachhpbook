<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Validator;
use Cart;
class CouponController extends Controller
{
    //
    public function addCoupon(Request $request){
    	if($request->isMethod('post')){
    		$v = Validator::make($request->all(),[
    			'code'=>'unique:coupons,code'
    		],
    		[
    			'code.unique'=>'Mã giảm giá đã tồn tại'
    		]
    		);
    		if($v->fails()){
    			return redirect()->back()->withErrors($v->errors());
    		}
    		$coupon = new Coupon();
    		$coupon->code = $request->code;
    		$coupon->discount = $request->discount/100;
    		$coupon->expiry_date = $request->expiry_date;
    		if(isset($request->status)){
    			$coupon->status = $request->status;
    		}else{
    			$coupon->status = 0;
    		}
    		
    		$coupon->save();
    		return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm mã thành công']);
    	}
    	return view('admin.pages.add_coupon');
    }
    public function viewCoupon(){
    	$coupon = Coupon::get();
    	return view('admin.pages.view_coupon',compact('coupon'));
    }
    public function deleteCoupon($id){
    	$coupon = Coupon::find($id);
    	if(!empty($coupon)){
    		$coupon->delete();
    		return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa mã thành công']);
    	}else{
    		return redirect()->back()->with(['flash_message'=>'danger','message'=>'Không thể thực hiện']);
    	}
    	
    }
    public function editCoupon(Request $request, $id){
    	$coupon = Coupon::find($id);
    	if(!empty($coupon)){
    		if($request->isMethod('post')){
    			$coupon->code = $request->code;
    			$coupon->discount = $request->discount/100;
	    		$coupon->expiry_date = $request->expiry_date;
	    		if(isset($request->status)){
	    			$coupon->status = $request->status;
	    		}else{
	    			$coupon->status = 0;
	    		}
	    		$coupon->save();
	    		return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa mã thành công']);
    		}
    		return view('admin.pages.edit_coupon',compact('coupon'));
    	}else{
    		return redirect()->back()->with(['flash_message'=>'danger','message'=>'Không thể thực hiện']);
    	}
    }
    public function ajaxCoupon(Request $request){
        if($request->ajax()){
            $message= "Không thể sử dụng mã này.";
            $value = $request->amount_discount;
            $data = number_format($request->amount_discount,0,',','.')." đ";
            if($request->amount_total==Cart::getTotal()){
                 
                $coupon = Coupon::where('code',$request->code)->first();
                if(!empty($coupon)){
                    $value = $coupon->discount*$request->amount_total;
                    $data = number_format($coupon->discount*$request->amount_total,0,',','.'). " đ";
                    $total = $request->amount_total - $value;
                    $data2 = number_format($total,0,',','.'). " đ";
                    return [$value,$data,$total,$data2,""];
                }else{    
                    return [$value,$data,$request->amount_total,number_format($request->amount_total,0,',','.'). " đ",$message];
                }
            }else{
                return [$value,$data,$request->amount_total,number_format($request->amount_total,0,',','.'). " đ",$message];
            }
        }
    }
}
