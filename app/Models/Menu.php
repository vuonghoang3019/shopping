<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $name = 'name';
    protected $table = 'menus';
    protected $parent_id = 'parent_id';
    protected $slug = 'slug';
    protected $fillable = ['id','name','parent_id','slug'];


}




