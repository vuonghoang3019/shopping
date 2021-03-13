<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;
    protected $table = 'user_test';
    protected $fillable = ['name','email','password','image_path','image_name'];
    public function role_tests()
    {
        return $this->belongsToMany(RoleTest::class,'user_module','usertest_id','roletest_id');
    }
}

