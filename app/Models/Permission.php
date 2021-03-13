<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = ['name','display_name','parent_id','key_code'];
    public function PermissionsChild()
    {
        return $this->hasMany(Permission::class,'parent_id');
    }
    public function Role_Permission()
    {
        return $this->belongsToMany(Role::class,'permission_role','permission_id','role_id');
    }
}
