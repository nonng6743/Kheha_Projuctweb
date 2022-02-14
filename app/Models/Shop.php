<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id_seller',
        'id_area',
        'nameshop',
        'category_type',
        'lat',
        'long',
        'image',
    ];

    public function seller(){
        return $this->hasOne(Seller::class,'id','id_seller');
    }
    public function area(){
        return $this->hasOne(Area::class,'id','id_area');
    }

}
