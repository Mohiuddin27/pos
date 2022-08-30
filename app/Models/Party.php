<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function partytype(){
        return $this->belongsTo('App\Models\Partytype','party_type','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','created_by','updated_by','id');
    }
    public function admin(){
        return $this->belongsTo('App\Models\Admin','created_by','updated_by','id');
    }
}
