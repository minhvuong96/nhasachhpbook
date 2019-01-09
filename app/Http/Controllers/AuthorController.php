<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use Validator;
class AuthorController extends Controller
{
    //
    public function addAuthor(Request $request){
        if($request->isMethod('post')){
            $v = Validator::make($request->all(),[
                'name'=>'unique:authors,name'
            ],
            [
                'name.unique'=>'Tác giả đã tồn tại'
            ]
            );
            if($v->fails()){
                return redirect()->back()->withErrors($v->errors());
            }
            $author = new Author;
            $author->name = $request->name;
            $author->alias = changeTitle($request->name);
            if (isset($request->description)) {
                # code...
                $author->description = $request->description;
            }
            
            $author->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm tác giả thành công']);
            
        }
        return view('admin.pages.add_author');
    }
    public function viewAuthors(Request $request){
        $author = Author::select('id','name')->get()->toArray();
        return view('admin.pages.view_author', compact('author'));
    }
    public function editAuthor(Request $request, $id){
        if($request->isMethod('post')){
            $author_edit = Author::find($id);
            $author_edit->name = $request->name;
            $author_edit->alias = changeTitle($request->name);
            if(isset($request->description)){
                $author_edit->description = $request->description;
            }
            
            $author_edit->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa tác giả thành công']);
        }
        $author = Author::find($id);
        return view('admin.pages.edit_author', compact('author'));
    }
    public function deleteAuthor($id){
        $author = Author::find($id);
        $author->delete($author);
        return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa tác giả thành công']);
    }
}
