<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseTransfer extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function currentWarehouse(){
        return $this->belongsTo('App\Models\Warehouse','current_warehouse_id','id');
    }
    public function transferWarehouse(){
        return $this->belongsTo('App\Models\Warehouse','transfer_warehouse_id','id');
    }

}
