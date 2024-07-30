<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $guarded = [];

    public function customer(){
        return $this->hasOne(Customer::class,'id', 'customer_id');
    }
    public function orderProducts(){
        return $this->hasMany(OrderProduct::class, 'orderNumber', 'id');
    }
    public function orderdelivary(){
        return $this->hasOne(DelivaryLocation::class, 'orderNumber', 'id');
    }
    
}
