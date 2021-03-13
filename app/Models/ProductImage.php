<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_image';
    protected $fillable = ['image_path','image_name','product_id'];
    public function ImageProduct()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
