<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Transaction;
use Hash,Validator;
use Carbon\Carbon;
use DB;
use App\Report;
use App\Coupon;
class AdminController extends Controller
{
    public function index(){      
        $now = Carbon::now();
        $nowString = $now->toDateTimeString();
        $month = $now->month;
        $year = $now->year;
        $previous = $now->subMonth();
        $report_now = Report::where([
            ['month','=',$month],
            ['year','=',$year]
        ])->first();
        
        $previous_report  = Report::where([
            ['month','=',$previous->month],
            ['year','=',$previous->year]
        ])->first();
        
        $report = Report::where('year',$year)->get();
        
        $transaction = Transaction::where('status',4)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)
        ->with('products')->get();

        if(count($report_now)==0){
            $new_report = new Report();  
            $new_report->month = $month;
            $new_report->year = $year;
            if(!count($transaction)==0){
                $new_report->countTransaction = $transaction->count('id');
                $new_report->sumTransaction = $transaction->sum('amount_total');
                $new_report->avgTransaction = $transaction->avg('amount_total');
                $sumQuantity =0;
                foreach($transaction as $value){

                    $pro_tran = DB::table('product_transaction')->where('transaction_id',$value->id)->get();
                foreach($pro_tran as $value2){
                    $sumQuantity = $sumQuantity + $value2->quantity;

                }
                }
                $new_report->sumQuantity = $sumQuantity;
                $new_report->save();
                foreach($transaction as $value){
                    $value->report_id = $new_report->id;
                    $value->save();
                }
            } else{
                $new_report->countTransaction = 0;
                $new_report->sumTransaction = 0;
                $new_report->avgTransaction =0;
                 $new_report->sumQuantity = 0;
                 $new_report->save();
            }   
        }else{
            $report_now->month = $month;
            $report_now->year = $year;
            if(!count($transaction)==0){
                $report_now->countTransaction = $transaction->count('id');
                $report_now->sumTransaction = $transaction->sum('amount_total');
                $report_now->avgTransaction = $transaction->avg('amount_total');
                $sumQuantity =0;
                foreach($transaction as $value){
                $pro_tran = DB::table('product_transaction')->where('transaction_id',$value->id)->get();
                foreach($pro_tran as $value2){
                    $sumQuantity = $sumQuantity + $value2->quantity;
                }
                }
                $report_now->sumQuantity = $sumQuantity;
                $report_now->save();
                foreach($transaction as $value){
                    $value->report_id = $report_now->id;
                    $value->save();
                } 
            }else{
                $report_now->countTransaction = 0;
                $report_now->sumTransaction = 0;
                $report_now->avgTransaction =0;
                 $report_now->sumQuantity = 0;
                 $report_now->save();
            }
        }
        //print_r($report_now);die;
    	return view('admin.pages.index',compact('report_now','report','previous_report','nowString','transaction'));
    }

    public function login(Request $request){
        if(Auth::check()){
            return redirect('/admin/index');
        }else{
    	if($request->isMethod('post')){
    		$data = $request->input();
    		if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'admin'=>'1'])){
    			return redirect('/admin/index');
    		}else{
    			return redirect('/admin')->with(['flash_message'=>'danger','message'=>'Sai Email hoặc Mật khẩu.']);
            }
    	}
    	return view('admin.pages.login');
        }
    }

    public function logout(){
        Auth::logout();
    	return redirect('/admin')->with(['flash_message'=>'success','message'=>'Đăng xuất thành công.']);
    }
    public function settings(){
        return view('admin.pages.settings');
    }
    public function checkPass(Request $request){
        $data = $request->all();
        $current_password = $data['current_password'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password, $check_password->password)){
            return "true"; die;
        }
        else{
            return "false";die;
        }
    }
    public function updatePassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['email'=>Auth::user()->email])->first();
        if(Hash::check($current_password, $check_password->password)){
            $new_password = Hash::make($data['new_pwd']);
            $check_password->password = $new_password;
            $check_password->save();
            return redirect('admin/settings')->with(['flash_message'=>'success','message'=>'Đổi mật khẩu thành công.']);
        }
        else{
            return redirect('admin/settings')->with(['flash_message'=>'danger','message'=>'Mật khẩu hiện tại không chính xác.']);
        }
    }

    public function addUser(Request $request){
        if($request->isMethod('post')){
            $v = Validator::make($request->all(),[
                'email'=>'unique:users,email'
            ],
            [
                'email.unique'=>'Email đã tồn tại'
            ]
            );
            if($v->fails()){
                return redirect()->back()->withErrors($v->errors());
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if(isset($request->admin)){
                $user->admin = $request->admin;
            }
            $user->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm thành viên thành công']);
        }
        return view('admin.pages.add_user');
    }
    public function viewUser(){
        $user = User::orderBy( 'name', 'desc')->where('id','<>',1)->get();
        return view('admin.pages.view_user',compact('user'));
    }
    public function deleteUser($id){
        if($id!=1){
        $user = User::find($id);
        $store = $user->transactions;
        foreach ($store as $value) {
            $value->user_id = 1;
            $value->save();
        }
        $user->delete($id);
        return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa thành viên thành công']);
    }else{
        return redirect()->back();
    }
    }
    public function editUser(Request $request, $id){
        if($request->isMethod('post')){
            $editUser = User::find($id);
            $editUser->name = $request->name;
            $editUser->email = $request->email;
            if(isset($request->admin)){
                $editUser->admin = $request->admin;
            }
            $editUser->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa thành viên thành công']);
        }
        $user = User::find($id);
        return view('admin.pages.edit_user',compact('user'));
    }
    
}
