<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleDetail extends Model
{
    protected $table = 'module_detail';
    protected $fillable = ['code','display_name','value','module_id','soft'];
}
