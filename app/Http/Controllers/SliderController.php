<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Validator;
use File;
class SliderController extends Controller
{
    //
    public function addSlider(Request $request){
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
            $slider = new Slider;
            $slider->link = $request->link;
            if($request->hasFile('image')){
                $filename= $request->file('image')->getClientOriginalName();
                $request->file('image')->move('admin_public/upload/sliders/',$filename);
                $slider->image= $filename;
            }
            $slider->position = $request->position;
            $slider->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm slider thành công']);
        }
        return view('admin.pages.add_slider');
    }
    public function viewSlider(){
        $slider = Slider::orderBy('position','ASC')->get()->toArray();
        return view('admin.pages.view_slider', compact('slider'));
    }

    public function editSlider(Request $request,$id){
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
            $slider_edit = Slider::find($id);
            $slider_edit->link = $request->link;
            if($request->hasFile('image')){
                $filename= $request->file('image')->getClientOriginalName();
                $request->file('image')->move('admin_public/upload/sliders/',$filename);
                $slider_edit->image= $filename;
                if(File::exists('admin_public/upload/sliders/'.$request->image_current)){
                    File::delete('admin_public/upload/sliders/'.$request->image_current);
                }
            }
            $slider_edit->position = $request->position;
            $slider_edit->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa slider thành công']);
            
        }
        $slider = Slider::find($id);
        return view('admin.pages.edit_slider',compact('slider'));
    }

    public function deleteSlider($id){
        $slider = Slider::find($id);
        $slider->delete($id);
        File::delete('admin_public/upload/sliders/'.$slider->image);
        return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa slider thành công']);
    }
}
