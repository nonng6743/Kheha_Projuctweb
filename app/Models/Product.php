<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_shop',
        'nameproduct',
        'detail',
        'id_subcategory',
        'image',
        'view',
    ];

    public function shop(){
        return $this->hasOne(Shop::class,'id','id_shop');
    }
    public function subcategory(){
        return $this->hasOne(Subcategorie::class,'id','id_subcategory');
    }
}
