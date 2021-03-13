<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id','customer_id','total','note','status'];
    const STATUS_DONE = 1;
    const STATUS = 0;
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
