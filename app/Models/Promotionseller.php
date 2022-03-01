<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotionseller extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_seller',
        'detailpromotion',
        'status',
        'image'
    ];

}
