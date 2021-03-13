<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = ['name','route','code','soft'];
    public function details()
    {
        return $this->hasMany(ModuleDetail::class, 'module_id', 'id');
    }
    public function child()
    {
        return $this->hasMany(Module::class, 'parent_id', 'id');
    }
}
