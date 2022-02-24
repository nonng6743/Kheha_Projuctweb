<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatmanager extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'id_manager',
        'id_seller',
        'status'
    ];

    public function seller(){
        return $this->hasOne(Seller::class,'id','id_seller');
    }

}
