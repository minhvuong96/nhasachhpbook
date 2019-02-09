<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use App\Publisher;
use App\Author;
use App\Comment;
use App\Slider;
use App\Banner;
use App\CartModel;
use Auth;
use Validator;
use Hash;
use Cart;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Mail;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // Trang chủ
    public function index()
    {
        $category = Category::whereIn('id',[14,15,21,22])->get();
        $slider = Slider::orderBy('position','ASC')->get()->toArray();
        $banner = Banner::orderBy('position','ASC')->get()->toArray();
        if(Auth::check()){

        }
        return view('hpbook.pages.index',compact('category','slider','banner'));
    }
    // Trang sách theo thể loại
    public function product($alias){
        $cateId = Category::where('alias',$alias)->get()->toArray();

        if(!empty($cateId)){
            $product = Product::where('cate_id',$cateId[0]['id'])->where('quantity','>',0)->select('id','name','alias','image','price','discount')->paginate(20);
            $saleProduct = Product::where('cate_id',$cateId[0]['id'])->where('quantity','>',0)->select('id','name','alias','image','price','discount')->orderBy('discount','DESC')->skip(0)->take(5)->get();
            $bestSellerProduct = Product::where('cate_id',$cateId[0]['id'])->select('id','name','alias','image','price','discount')->orderBy('count_buy','DESC')->skip(0)->take(5)->get();
            return view('hpbook.pages.product',compact('product','cateId','saleProduct','bestSellerProduct'));
        }else{
            return redirect('/');
        }
        
    }
    // Trang chi tiết từng cuốn sách
    public function detailProduct(Request $request,$alias){
        $product = Product::where('alias',$alias)->first();
        if(!empty($product)){
            $cate = Category::where('id',$product->cate_id)->select('id','name','alias')->first();
            $publisher = Product::find($product->id)->publisher;
            $authors = Product::find($product->id)->authors;
            $relateProduct = Product::where([['cate_id',$cate->id],['id','<>',$product->id]])->where('quantity','>',0)->inRandomOrder()->take(5)->get();
            $bestSellerProduct = Product::where([['cate_id',$cate->id],['id','<>',$product->id]])->where('quantity','>',0)->orderBy('count_buy','DESC')->skip(0)->take(5)->get();
            $comment = Comment::where([['product_id',$product->id],['status',1]])->paginate(5);
            $scores = 0;
            $i =0;
            foreach ($comment as $value) {
                $scores = $scores + $value->score;
                $i = $i+1;
            }
            if($i!=0){
                $rating = round((float)$scores/$i,1);
                if($product->rating != $rating){
                    $product->rating = $rating;
                    $product->save();
                }
            }
            if($request->isMethod('post')){
               $v = Validator::make($request->all(),[

                'captcha' => 'required|captcha'
            ],
            [

                'captcha.required'=>'Chưa nhập mã xác nhận',
                'captcha.captcha'=>'Sai mã xác nhận'
            ]
        );
               if($v->fails()){
                return redirect()->back()->withErrors($v->errors());
            }
            $newComment = new Comment();
            $newComment->content = $request->content;
            $newComment->score = $request->voteStar;
            $newComment->product_id = $product->id;
            $newComment->user_id = Auth::user()->id;
            $newComment->status = 0;
            $newComment->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm bình luận thành công. Đang chờ được phê duyệt.']);
        }
        return view('hpbook.pages.detail-product',compact('product','cate','publisher','authors','relateProduct','bestSellerProduct','comment'));
    }else{
        return redirect('/');
    }
}
    //Trang login
public function login(Request $request){
    if(Auth::check()){
        return redirect('/');
    }else{
        if($request->isMethod('post')){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $cart = CartModel::where('user_id',Auth::user()->id)->get();
                if(!empty($cart)){
                    foreach($cart as $value){
                        Cart::add(array(
                          'id' => $value->product_id,
                          'name' => $value->product_name,
                          'price' =>$value->price,
                          'quantity' => $value->quantity,
                          'attributes' => array(
                            'image' => $value->image,
                            'alias'=>$value->alias
                        )
                      ));
                        $product = Product::find($value->product_id);
                        $product->quantity = $product->quantity - $value->quantity;
                        $product->count_buy = $product->count_buy + $value->quantity;
                        $product->save();
                    }
                    $cart = CartModel::where('user_id',Auth::user()->id)->delete();
                }
                return redirect()->back();
            }else{
                return redirect()->back()->with(['flash_message'=>'danger','message'=>'Sai email hoặc mật khẩu']);
            }
        }
    }
    return view('hpbook.pages.login');
}
public function logout(){
    foreach (Cart::getContent() as $value) {
        $product = Product::find($value->id);
        $cart = new CartModel();
        $cart->product_id = $value->id;
        $cart->product_name = $value->name;
        $cart->price = $value->price;
        $cart->quantity = $value->quantity;
        $cart->image = $value->attributes->image;
        $cart->alias = $value->attributes->alias;
        $cart->user_id = Auth::user()->id;
        $cart->save();
        $product->quantity = $product->quantity + $value->quantity;
        $product->count_buy = $product->count_buy - $value->quantity;
        $product->save();
    }
    Auth::logout();

    Cart::clear();
    return redirect()->back();
}
    //Trang đăng ký
public function register(Request $request){
    if(Auth::check()){
        return redirect('/');
    }else{
        if($request->isMethod('post')){
            $v = Validator::make($request->all(),[
                'email'=>'unique:users,email',
                'captcha' => 'required|captcha'
            ],
            [
                'email.unique'=>'Email đã tồn tại',
                'captcha.required'=>'Chưa nhập mã xác nhận',
                'captcha.captcha'=>'Sai mã xác nhận'
            ]
        );
            if($v->fails()){
                return redirect()->back()->withErrors($v->errors());
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('/dang-nhap')->with(['flash_message'=>'success','message'=>'Đăng ký tài khoản thành công']);
        }
    }
    return view('hpbook.pages.register');
}
    //Quên mật khẩu
public function sendMailForgotPassword(Request $request){
    if($request->isMethod('post')){
        $user= User::where('email',$request->email)->first();
        if(count($user)==0){
            return redirect()->back()->with(['flash_message'=>'danger','message'=>'Tài khoản không tồn tại']);
        }else{
            $name = $user->name;
            $email = $user->email;
            $remember_token = $user->remember_token;
            Mail::to($email)->send(new SendMailable($name,$remember_token));
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Gửi mail thành công']);;
        }
    }
    return view('hpbook.pages.sendMail');
}
    //reset mật khẩu
public function resetPassword(Request $request){
    if($request->isMethod('post')){
        $user = User::where(DB::raw('BINARY `remember_token`'), $request->remember_token)->first();;
        if(count($user)==0){
            return redirect()->back()->with(['flash_message'=>'danger','message'=>'Mã khôi phục không đúng']);
        }else{
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thay đổi mật khẩu thành công']);
        }
    }
    return view('hpbook.pages.resetPassword');
}
    //Trang đổi mật khẩu
public function changePass(Request $request){
    if($request->isMethod('post')){
        $user = User::find(Auth::user()->id);
        if(!Hash::check($request->oldPassword, $user->password))
        {
            return redirect()->back()->with(['flash_message'=>'danger','message'=>'Nhập sai mật khẩu cũ']);
        }else{
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Đổi mật khẩu thành công']);
        }
    }
    return view('hpbook.pages.change-password');
}
public function handler404(){
    return redirect()->back();
}
    //Tìm kiếm
public function getSearch(Request $request){

    $publisher = Publisher::with('products')->where('name','like','%'.$request->keySearch.'%')->get()->toArray();
    $author = Author::with('products')->where('name','like','%'.$request->keySearch.'%')->get()->toArray();
        //$product = Product::where('name','like','%'.$request->keySearch.'%')->paginate(25)->toArray();
    $product = Product::join('publishers', 'publishers.id', '=', 'products.publisher_id')
    ->join('author_product', 'products.id', '=', 'author_product.product_id')
    ->join('authors', 'authors.id', '=', 'author_product.author_id')
    ->select('products.*','authors.name as author_name','publishers.name as publisher_name')
    ->where('products.name','like','%'.$request->keySearch.'%')->orWhere('authors.name','like','%'.$request->keySearch.'%')->orWhere('publishers.name','like','%'.$request->keySearch.'%');
    $count =  $product->get()->count();
    $data = $product->paginate(24);
    $data->withPath('/nhasachhpbook.vn/public/tim-kiem?keySearch='.$request->keySearch);
    return view('hpbook.pages.search',compact('data','count'));
}
    //ajax sắp xếp sản phẩm
public function productSort(Request $request){
    switch ($request->option) {
        case 1:
                # code...
        $product = Product::where('cate_id',$request->cate_id)->where('quantity','>',0)->select('id','name','alias','image','price','discount')->paginate(20);
        $cate = Category::find($request->cate_id);
        $product->withPath('/nhasachhpbook.vn/public/the-loai/'.$cate->alias);
        return view('hpbook.pages.productAjax',compact('product'));
        break;
        case 2:
                # code...
        $product = Product::where('cate_id',$request->cate_id)->where('quantity','>',0)->orderBy('count_buy','DESC')->select('id','name','alias','image','price','discount')->paginate(20);
        $cate = Category::find($request->cate_id);
        $product->withPath('/nhasachhpbook.vn/public/the-loai/'.$cate->alias);
        return view('hpbook.pages.productAjax',compact('product'));
        break;
        case 3:
                # code...
        $product = Product::where('cate_id',$request->cate_id)->where('quantity','>',0)->orderBy('price_total','ASC')->select('id','name','alias','image','price','discount')->paginate(20);
        $cate = Category::find($request->cate_id);
        $product->withPath('/nhasachhpbook.vn/public/the-loai/'.$cate->alias);
        return view('hpbook.pages.productAjax',compact('product'));
        break;
        case 4:
                # code...
        $product = Product::where('cate_id',$request->cate_id)->where('quantity','>',0)->orderBy('price_total','DESC')->select('id','name','alias','image','price','discount')->paginate(20);
        $cate = Category::find($request->cate_id);
        $product->withPath('/nhasachhpbook.vn/public/the-loai/'.$cate->alias);
        return view('hpbook.pages.productAjax',compact('product'));
        break;
        case 5:
                # code...
        $product = Product::where('cate_id',$request->cate_id)->where('quantity','>',0)->orderBy('id','DESC')->select('id','name','alias','image','price','discount')->paginate(20);
        $cate = Category::find($request->cate_id);
        $product->withPath('/nhasachhpbook.vn/public/the-loai/'.$cate->alias);
        return view('hpbook.pages.productAjax',compact('product'));
        break;

        default:
                # code...
        $product = Product::where('cate_id',$request->cate_id)->where('quantity','>',0)->orderBy('id','ASC')->select('id','name','alias','image','price','discount')->paginate(20);
        $cate = Category::find($request->cate_id);
        $product->withPath('/nhasachhpbook.vn/public/the-loai/'.$cate->alias);
        return view('hpbook.pages.productAjax',compact('product'));
        break;
    }
}
}
