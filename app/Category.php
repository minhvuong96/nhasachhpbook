<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    // 1 danh muc co nhieu san pham sach
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
