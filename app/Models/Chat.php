<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'id_user',
        'id_shop',
        'status'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','id_user');
    }
    public function shop(){
        return $this->hasOne(Shop::class,'id','id_shop');
    }
}
