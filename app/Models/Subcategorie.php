<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_category',
        'namesubcategory',
    ];

    public function categories(){
        return $this->hasOne(Categorie::class,'id','id_category');
    }
}
