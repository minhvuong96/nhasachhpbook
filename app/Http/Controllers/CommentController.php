<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
class CommentController extends Controller
{
    //
    public function viewComment(){
    	$comment = Comment::where('status',1)->with('user','product')->get()->toArray();
    	return view('admin.pages.view_comment',compact('comment'));
    }
    public function deleteComment(Request $request,$id){
    	$comment = Comment::find($id);
    	if($request->ajax()){
    		$comment->delete($id);
    		return 'success';
    	}else{
	    	$comment->delete($id);
	    	return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa bình luận thành công']);
    	}

    }
    //Danh sách bình luận mới
    public function newComment(){
    	$newComment = Comment::where('status',0)->with('user','product')->get()->toArray();
    	return view('admin.pages.new_comment',compact('newComment'));
    }
    //Duyệt bình luận
    public function approvalComment(Request $request){
    	$comment = Comment::find($request->idComment);
    	$comment->status =1;
    	$comment->save();
    	return 'success';
    }
    //Bình luận của khách hàng
    public function myComment(){
        $myComment = Comment::where('user_id',Auth::user()->id)->with('product')->get();
        return view('hpbook.pages.list-comment',compact('myComment'));
    }
    public function deleteMyComment(Request $request){
        if ($request->ajax()) {
            $comment = Comment::find($request->idComment)->delete();
            return 'success';
        }
    }
    //Chi tiết bình luận
    public function viewMyComment(Request $request,$id){
        if($request->isMethod('post')){
            $comment = Comment::find($id);
            if(!empty($comment)){
                $comment->score = $request->voteStar;
                $comment->content = $request->content;
                $comment->status=0;
                $comment->save();
                return redirect()->back()->with(['flash_message'=>'success','message'=>'Gửi bình luận thành công']);
            }else{
                return redirect('/nhan-xet-cua-toi');
            }
            
        }
        $myComment = Comment::find($id);
        if(!empty($myComment)){
            return view('hpbook.pages.detail-comment',compact('myComment'));
        }else{
                return redirect('/nhan-xet-cua-toi');
            }
    }
}
