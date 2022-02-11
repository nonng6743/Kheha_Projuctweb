<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;


    protected $fillable = [
       'id_seller',
       'namearea',
       'image',
       'detail',
       'scale',
       'rentalfee',
       'lat',
       'long',
    ];
}
