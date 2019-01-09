<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\Transaction;

use Carbon\Carbon;
use DB;
use App\Report;
class ReportAutoLoadController extends Controller
{
    //
    public function index(){      
        $now = Carbon::now();
        $nowString = $now->toDateTimeString();
        $month = $now->month;
        $year = $now->year;
        $end = $now->endOfMonth()->toDateTimeString();
        //echo $now;die;
        
        //print_r($transaction);die;
        $report = Report::where([
            ['month','=',$now->month],
            ['year','=',$now->year]
        ])->first();
        //echo count($report);die;
        $transaction = Transaction::where('status',4)->whereMonth('created_at', '=', $now->month)->whereYear('created_at','=',$now->year)
        ->with('products')->get();
        if(count($report)==0){
            //echo "yes".$now->month;die;
            $new_report = new Report();   
            $new_report->month = $now->month;
            $new_report->year = $now->year;
            $new_report->countTransaction = $transaction->count('id');
            $new_report->sumTransaction = $transaction->sum('amount_total');
            $new_report->avgTransaction = $transaction->avg('amount_total');
            $sumQuantity =0;
            //echo $avgTransaction;
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
            //print_r($new_report);die;
            //print_r($transaction = $transaction->toArray());die;
        
        }else{
            //print_r($transaction->toArray());die;
            $report->month = $now->month;
            $report->year = $now->year;
            $report->countTransaction = $transaction->count('id');
            $report->sumTransaction = $transaction->sum('amount_total');
            $report->avgTransaction = $transaction->avg('amount_total');
            $sumQuantity =0;
            //echo $avgTransaction;
            foreach($transaction as $value){
            $pro_tran = DB::table('product_transaction')->where('transaction_id',$value->id)->get();
            foreach($pro_tran as $value2){
                $sumQuantity = $sumQuantity + $value2->quantity;
            }
            }
            $report->sumQuantity = $sumQuantity;
            $report->save();
            //echo $report->id;die;
            foreach($transaction as $value){
                $value->report_id = $report->id;
                $value->save();
               // echo $value->report_id;die;
            }   
        }
            //print_r($report);die;
        
    	//return view('admin.pages.index',compact('countTransaction','sumTransaction','avgTransaction','sumQuantity','month','year'));
    }
}
