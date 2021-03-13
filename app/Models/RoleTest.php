<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTest extends Model
{
    use HasFactory;
    protected $table = 'role_test';
    protected $fillable = ['name','display_name'];
    public function role_moduleDetail()
    {
        return $this->belongsToMany(ModuleDetail::class,'module_role','role_id','module_detail_id');
    }
}
