<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Validator;
use File;
class BannerController extends Controller
{
    //
    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $v = Validator::make($request->all(),[
    			'image' => 'required|image|max:2048',
    		],
    		[
                'image.required'=>'Vui lòng chọn hình đại diện',
                'image.image'=>'File chọn phải là hình',
                'image.max'=>'Kích thước file quá lớn',
    		]
    		);
    		if($v->fails()){
    			return redirect()->back()->withErrors($v->errors());
            }
            $banner = new Banner;
            $banner->link = $request->link;
            if($request->hasFile('image')){
                $filename= $request->file('image')->getClientOriginalName();
                $request->file('image')->move('admin_public/upload/banners/',$filename);
                $banner->image= $filename;
            }
            $banner->position = $request->position;
            $banner->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm banner thành công']);
        }
        return view('admin.pages.add_banner');
    }
    public function viewBanner(){
        $banner = Banner::orderBy('position','ASC')->get()->toArray();
        return view('admin.pages.view_banner', compact('banner'));
    }

    public function editBanner(Request $request,$id){
        if($request->isMethod('post')){
            $v = Validator::make($request->all(),[
    			'image' => 'image|max:2048',
    		],
    		[
                'image.image'=>'File chọn phải là hình',
                'image.max'=>'Kích thước file quá lớn',
    		]
    		);
    		if($v->fails()){
    			return redirect()->back()->withErrors($v->errors());
            }
            $banner_edit = Banner::find($id);
            $banner_edit->link = $request->link;
            if($request->hasFile('image')){
                $filename= $request->file('image')->getClientOriginalName();
                $request->file('image')->move('admin_public/upload/banners/',$filename);
                $banner_edit->image= $filename;
                if(File::exists('admin_public/upload/banners/'.$request->image_current)){
                    File::delete('admin_public/upload/banners/'.$request->image_current);
                }
            }
            $banner_edit->position = $request->position;
            $banner_edit->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa banner thành công']);
            
        }
        $banner = Banner::find($id);
        return view('admin.pages.edit_banner',compact('banner'));
    }

    public function deleteBanner($id){
        $banner = Banner::find($id);
        $banner->delete($id);
        File::delete('admin_public/upload/banners/'.$banner->image);
        return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa banner thành công']);
    }
}
