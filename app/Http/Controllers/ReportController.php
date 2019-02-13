<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;//Khai báo authentication
use Session;//Khai báo session

use App\Transaction;//Khai báo model Transaction

use Carbon\Carbon;//Khai báo Carbon xử lý với thời gian
use DB;
use App\Report;
class ReportController extends Controller
{

    public function reportYear($year){
        $now = Carbon::now();
        $nowString = $now->toDateTimeString();
        $report = Report::where('year',$year)->orderBy('created_at','DESC')->get();
        if(count($report)!=0){
            return view('admin.pages.view_reportYear',compact('report','nowString','year'));

        }else{
            return redirect()->back();
        }
        
    }

    public function reportMonth($year,$month){
        $now = Carbon::now();
        $nowString = $now->toDateTimeString();
        $report = Report::where([['year',$year],['month',$month]])->first();
        if(!empty($report)){
            $transaction = Transaction::where('report_id',$report->id)->get()->toArray();
            $sumQuantity = array();
            foreach($transaction as $value){
                $pro_tran = DB::table('product_transaction')->where('transaction_id',$value['id'])->groupBy('transaction_id')->get(array(
                    DB::raw('transaction_id as id'),
                    DB::raw('SUM(quantity) as "sumQuantity"')
                ))->first();
                    array_push($sumQuantity, $pro_tran->sumQuantity);
            }
            for($i=0;$i<count($transaction);$i++){
                $transaction[$i]['sumQuantity'] = $sumQuantity[$i];
            }
            $data = Transaction::where('report_id',$report->id)->groupBy('date')->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "countTransaction"'),
                DB::raw('SUM(amount_total) as "sumTransaction"'),
            ))->toArray();

            $arrSum = array();
            
            foreach($data as $value){
                $countQuantity = 0;
                foreach($transaction as $value2){
                    $created_at = (string)date("Y-m-d",strtotime($value2['created_at']));
                    if(Date($created_at)==$value['date']){
                        $countQuantity = $countQuantity + $value2['sumQuantity'];
                    }
                }
                array_push($arrSum,$countQuantity);
            }
            for($i=0;$i<count($data);$i++){
                $data[$i]['sumQuantity'] = $arrSum[$i];
            }
            return view('admin.pages.view_reportMonth',compact('report','data','nowString'));
        }else{
            return redirect()->back();
        }
        
    }

}
