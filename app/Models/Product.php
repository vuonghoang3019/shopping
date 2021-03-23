<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name','price','sale','feature_image_path','feature_image_name',
                           'content','user_id','category_id','quantity','status','total_rate','total_number'];
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id')->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function productImage()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }


}
