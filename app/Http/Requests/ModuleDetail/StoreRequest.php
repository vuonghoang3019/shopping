<?php

namespace App\Http\Requests\ModuleDetail;

use Illuminate\Http\Request;

class StoreRequest extends Request
{
    public function rules()
    {

    }

    public function Data()
    {
        return [
            'code'         => $this->display_name,
            'display_name' => $this->display_name,
            'module_id'    => $this->module_id,
            'soft'         => 1,
            'value'        => join(',', $this->module_child)
        ];
    }
}
