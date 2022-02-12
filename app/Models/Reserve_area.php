<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve_area extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_seller',
        'id_area'
    ];

    public function seller(){
        return $this->hasOne(Seller::class,'id','id_seller');
    }
    public function area(){
        return $this->hasOne(Area::class,'id','id_area');
    }
}
