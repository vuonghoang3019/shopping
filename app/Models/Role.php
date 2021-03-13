<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name','display_name'];
    public function Permission_Roles()
    {
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }
}
