<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image'
    ];
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_role','user_id','role_id');
    }
    public function checkPermissonAccess($permissionCheck)
    {
        // user login vao he thong co quyen sua danh muc, xem menu
        // B1: Lay duoc gia tri cua tat ca cac quyen cua user dang login trong he thong
        // B2: So sanh gia tri dua vao cua router hien tai xem co ton tai trong cac quyen ma minh da lay hay khong
        $roles = auth()->user()->roles;
        foreach ($roles as $role)
        {
            $permission = $role->Permission_Roles;
            if ($permission->contains('key_code',$permissionCheck))
            {
                return true;
            }
        }
        return false;
    }

}
