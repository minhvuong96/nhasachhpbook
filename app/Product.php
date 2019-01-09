<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['name','alias','cate_id','price',' discount','image','publisher_id','description','count_buy','quantity','publish_year','rating'];
    // 1 san pham thuoc ve 1 danh muc
    public function category(){
        return $this->belongsTo('App\Category');
    }
    // 1 san pham thuoc ve 1 nha xuat ban
    public function publisher(){
        return $this->belongsTo('App\Publisher');
    }
    public function authors(){
        return $this->belongsToMany('App\Author');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function transactions(){
        return $this->belongsToMany('App\Transaction');
    }
}
