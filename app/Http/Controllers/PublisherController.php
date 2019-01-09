<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publisher;
use Validator;
class PublisherController extends Controller
{
    public function addPubliser(Request $request){
        if($request->isMethod('post')){
            $v = Validator::make($request->all(),[
    			'name'=>'unique:publishers,name'
    		],
    		[
    			'name.unique'=>'Tên nhà xuất bản đã tồn tại'
    		]
    		);
    		if($v->fails()){
    			return redirect()->back()->withErrors($v->errors());
    		}
            $publisher = new Publisher;
            $publisher->name = $request->name;
            $publisher->alias = changeTitle($request->name);
            $publisher->email = $request->email;
            $publisher->address = $request->address;
            if(isset($request->description)){
                $publisher->description = $request->description;
            }
            
            $publisher->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm nhà xuất bản thành công']);
            
        }
        return view('admin.pages.add_publisher');
    }

    public function viewPublishers(){
        $publisher = Publisher::select('id','name','address','email')->get()->toArray();
        return view('admin.pages.view_publisher',compact('publisher'));
    }

    public function editPublisher(Request $request, $id){
        if($request->isMethod('post')){
            $publisher_edit = Publisher::find($id);
            $publisher_edit->name = $request->name;
            $publisher_edit->alias = changeTitle($request->name);
            $publisher_edit->email = $request->email;
            $publisher_edit->address = $request->address;
            if ($request->description) {
                # code...
                $publisher_edit->description = $request->description;
            }
            
            $publisher_edit->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa nhà xuất bản thành công']);
        }
        $publisher = Publisher::find($id);
        return view('admin.pages.edit_publisher', compact('publisher'));
    }

    public function deletePublisher($id){
        $publisher = Publisher::find($id);
        $publisher->delete($id);
        return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa nhà xuất bản thành công']);

    }
}
