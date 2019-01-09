<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table="transactions";

    public function products(){
    	return $this->belongsToMany('App\Product');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function report(){
        return $this->belongsTo('App\Report');
    }
}
