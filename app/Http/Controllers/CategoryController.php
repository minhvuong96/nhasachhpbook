<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;
class CategoryController extends Controller
{
    public function addCategory(Request $request){
    	if($request->isMethod('post')){
    		$v = Validator::make($request->all(),[
    			'name'=>'unique:categories,name'
    		],
    		[
    			'name.unique'=>'Tên danh mục đã tồn tại'
    		]
    		);
    		if($v->fails()){
    			return redirect()->back()->withErrors($v->errors());
    		}
    		$new_cate = new Category;
    		$new_cate->name = $request->name;
    		$new_cate->alias = changeTitle($request->name);
    		$new_cate->parent_id = $request->parent_id;
    		$new_cate->save();
    		return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm danh mục thành công']);

    	}
    	$cate = Category::get()->toArray();
    	return view('admin.pages.add_category',compact('cate'));
    }
    public function viewCategories(){
        $cate = Category::get()->toArray();
    	return view('admin.pages.view_categories',compact('cate'));
    }
    public function editCategories(Request $request,$id){
        if($request->isMethod('post')){
            $cate = Category::find($id);
            $cate->parent_id = $request->parent_id;
            $cate->name = $request->name;
            $cate->alias = changeTitle($request->name);
            $cate->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa danh mục thành công']);
        }
        $cate = Category::find($id)->toArray();
        $parent = Category::get()->toArray();
        return view('admin.pages.edit_categories',compact('cate','parent'));
    }
    public function deleteCategories($id){
        $parent = Category::where('parent_id',$id)->count();
        if($parent==0){
            $cate = Category::find($id);
            $cate->delete($id);
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa danh mục thành công']);
        }else{
            return redirect()->back()->with(['flash_message'=>'danger','message'=>'Không thể xóa danh mục này do có chứa danh mục con']);
        }
    }
}
