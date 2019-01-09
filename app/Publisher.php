<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //
    protected $table = 'publishers';
    protected $fillable = ['name','alias','address','email','description'];
    public $timestamps = false;

    //1 nha xuat ban co nhieu sach
    public function products()
    {
        return $this->hasMany('App\Product');
    }


}
