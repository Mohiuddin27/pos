<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function productCategory(){
        return $this->belongsTo('App\Models\ProductCategory','category_id','id');
    }
    public function productBrand(){
        return $this->belongsTo('App\Models\ProductBrand','brand_id','id');
    }
    public function productUnit(){
        return $this->belongsTo('App\Models\ProductUnit','unit_id','id');
    }



}
