<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Publisher;
use App\Author;
use Validator;
use File;
use Cart;
class ProductController extends Controller
{
    //
    public function addProduct(Request $request){
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
            $product = new Product;
            $product->name = $request->name;
            $product->alias = changeTitle($request->name);
            $product->price = $request->price;
            $product->discount = $request->discount;
            if(isset($request->description)){
                $product->description = $request->description;
            }
            
            $product->count_buy = $request->count_buy;
            $product->quantity = $request->quantity;
            $product->rating = $request->rating;
            $product->publish_year = $request->publish_year;
            if($request->hasFile('image')){
                $filename= $request->file('image')->getClientOriginalName();
                $request->file('image')->move('admin_public/upload/products/',$filename);
                $product->image= $filename;
            }
            $product->cate_id = $request->cate;
            $product->publisher_id = $request->publisher;
            $product->price_total = $request->price - $request->price*$request->discount/100;
            $product->save();
            $product_author = Product::find($product->id);
            $product_author->authors()->attach($request->author);
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Thêm sản phẩm thành công']);         
        }
        $cate = Category::get()->toArray();
        $publisher = Publisher::select('id','name')->get()->toArray();
        $author = Author::select('id','name')->get()->toArray();
        // author($author);
        return view('admin.pages.add_product',compact('cate','publisher','author'));
    }
    //Sách tồn kho
    public function viewProducts(){
        $product = Product::select('id','name','alias','cate_id','price','discount','image','publish_year','count_buy','publisher_id','quantity')->where('quantity','>',0)->get()->toArray();
        return view('admin.pages.view_product',compact('product'));
    }
    //Sách hết hàng
    public function outOfStock(){
        $product = Product::select('id','name','alias','cate_id','price','count_buy','discount','image','publish_year','publisher_id','quantity')->where('quantity','=',0)->get()->toArray();
        return view('admin.pages.view_product',compact('product'));
    }
    //Chính sửa sản phẩm
    public function editProduct(Request $request, $id){
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
            $product =  Product::find($id);
           if(!empty($product)){
             $product->name = $request->name;
            $product->alias = changeTitle($request->name);
            $product->price = $request->price;
            $product->discount = $request->discount;
            if(isset($request->description)){
                $product->description = $request->description;
            }
            $product->description = $request->description;
            $product->count_buy = $request->count_buy;
            $product->quantity = $request->quantity;
            $product->rating = $request->rating;
            $product->publish_year = $request->publish_year;
            $img_current = 'admin_public/upload/products/'.$request->image_current;
            if(!empty($request->file('image'))){
                $file_name = $request->file('image')->getClientOriginalName();
                $product->image = $file_name;
                $request->file('image')->move('admin_public/upload/products/',$file_name);
                if(File::exists($img_current)){
                    File::delete($img_current);
                }
            }
            $product->cate_id = $request->cate;
            $product->publisher_id = $request->publisher;
            $product->save();
            $product_author = Product::find($product->id);
            $product_author->authors()->sync($request->author);
            return redirect()->back()->with(['flash_message'=>'success','message'=>'Sửa sản phẩm thành công']);
        }else{
            return redirect('/admin/view-products');
        }
        }
        $product = Product::find($id);
        if(!empty($product)){
            $cate = Category::get()->toArray();
            $publisher = Publisher::select('id','name')->get()->toArray();
            $author = Author::select('id','name')->get()->toArray();
            return view('admin.pages.edit_product',compact('product','cate','publisher','author'));
        }
        else{
            return redirect('/admin/view-products');
        }
        
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        if(!empty($product)){
            File::delete('admin_public/upload/products/'.$product->image);
        $product->delete($id);
        return redirect()->back()->with(['flash_message'=>'success','message'=>'Xóa sản phẩm thành công']);
        }
        else{
            return redirect('/admin/view-products');
        }
        

    }
    public function btnPay(Request $request){
            $product = Product::find($request->idProduct);
            if($request->ipHiddenQty <= $product->quantity){
           Cart::add(array(
                  'id' => $product->id,
                  'name' => $product->name,
                  'price' => $product->price-$product->price*$product->discount/100,
                  'quantity' => $request->ipHiddenQty,
                  'attributes' => array(
                    'image' => $product->image,
                    'alias'=>$product->alias
                  )
            ));
           $product->quantity = $product->quantity - $request->ipHiddenQty;
           $product->count_buy = $product->count_buy + $request->ipHiddenQty;
           $product->save();
           return redirect('/dat-hang');
             }else{
                 return redirect()->back();
             }
    }
    //Thêm giỏ hàng
    public function addCart($id){
           $product = Product::find($id);
           if(!empty($product)){
            if($product->quantity>=1){
               Cart::add(array(
                      'id' => $product->id,
                      'name' => $product->name,
                      'price' => $product->price-$product->price*$product->discount/100,
                      'quantity' => 1,
                      'attributes' => array(
                        'image' => $product->image,
                        'alias'=>$product->alias
                      )
                ));
               $product->quantity = $product->quantity - 1;
               $product->count_buy = $product->count_buy + 1;
               $product->save();
               return redirect()->back();
            }else{
                return redirect('/');
            }
           }else{
                return redirect('/');
            }
           
    }
    //Thêm giỏ hàng kèm số lượng
    public function addCartQty(Request $request){
        if($request->isMethod('post')){
           $product = Product::find($request->idProduct);
           if($request->ipQty <= $product->quantity){
           Cart::add(array(
                  'id' => $request->idProduct,
                  'name' => $product->name,
                  'price' => $product->price-$product->price*$product->discount/100,
                  'quantity' => $request->ipQty,
                  'attributes' => array(
                    'image' => $product->image,
                    'alias'=>$product->alias
                  )
            ));
           $product->quantity = $product->quantity - $request->ipQty;
           $product->count_buy = $product->count_buy + $request->ipQty;
           $product->save();
           return redirect()->back();
        }else{
            return redirect()->back();
        }
        }
    }
    //Giỏ hàng
    public function viewCart(){
        return view('hpbook.pages.cart');
    }
    //Xóa 1 sản phẩm trong giỏ hàng
    public function deleteUnitCart(Request $request){
        if($request->ajax()){
            $product = Product::find($request->idUnitCart);
            $product->quantity = $product->quantity + Cart::get($request->idUnitCart)->quantity;
            $product->count_buy = $product->count_buy - Cart::get($request->idUnitCart)->quantity;
            $product->save();
            Cart::remove($request->idUnitCart);
            $total = number_format(Cart::getTotal(),0,',','.');
            return $total;
        }
    }
    //Cập nhật 1 sản phẩm trong giỏ hàng
    public function updateUnitCart(Request $request){
        if($request->ajax()){
            //$qty = $request->quantity;
            if($request->quantity!=Cart::get($request->idUnitCart)->quantity)
            {
                //$qty = $request->quantiy - Cart::get($request->idUnitCart)->quantity;
                
                $old = Cart::get($request->idUnitCart)->quantity - $request->quantity;
                Cart::update($request->idUnitCart,array('quantity'=>$request->quantity - Cart::get($request->idUnitCart)->quantity,));
                $product = Product::find($request->idUnitCart);
                // $product->quantity = $product->quantiy + Cart::get($request->idUnitCart)->quantity - $request->quantity;
                $product->quantity = $product->quantity + $old;
                $product->count_buy = $product->count_buy - $old;
                $product->save();
            }
            $totalUnitPrice =number_format( Cart::get($request->idUnitCart)->quantity*Cart::get($request->idUnitCart)->price,0,",",'.');
            $total = number_format(Cart::getTotal(),0,',','.');
            return [$totalUnitPrice,$total];
        }
    }

}
