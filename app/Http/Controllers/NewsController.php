<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    //
    public function addNews(Request $request){
        if($request->isMethod('post')){
            $news = new News;
            $news->title = $request->title;
            $news->alias = changeTitle($request->title);
            $news->content = $request->content;
            $news->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm bài viết thành công']);
        }
        return view('admin.pages.add_news');
    }
    public function viewNews(){
        $news = News::get()->toArray();
        return view('admin.pages.view_news',compact('news'));
    }
    public function editNews(Request $request,$id){
        if($request->isMethod('post')){
            $news_edit = News::find($id);
            if(!empty($news_edit)){
                $news_edit->title = $request->title;
                $news_edit->alias = changeTitle($request->title);
                $news_edit->content = $request->content;
                $news_edit->save();
                return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa bài viết thành công']);
            }else{
                return redirect('/admin/view-news');
            }
            
        }
        $news = News::find($id);
        if(!empty($news)){
            return view('admin.pages.edit_news',compact('news'));
        }else{
            return redirect('/admin/view-news');
        }
        
    }
    public function deleteNews($id){
        $news = News::find($id);
        if(!empty($news)){
            $news->delete($id);
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa bài viết thành công']);
        }else{
            return redirect('/admin/view-news');
        }
    }
    public function news($alias){
        $news = News::where('alias',$alias)->first();
        if(!empty($news)){
            return view('hpbook.pages.news',compact('news'));
        }else{
            return redirect('/');
        }
        
    }
}
