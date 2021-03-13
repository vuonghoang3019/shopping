<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingAddRequest;

use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SettingController extends Controller
{
    private $setting;
    use DeleteModelTrait;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    public function index()
    {
        $settings = $this->setting->paginate(5);
        return view('admin.setting.index',compact('settings'));
    }
    public function create()
    {
        return view('admin.setting.add');
    }
    public function store(SettingAddRequest $request)
    {
        try {
            $this->setting->create([
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'type'  => $request->type
            ]);
            return redirect()->route('settings.index');
        }
        catch (\Exception $exception)
        {
//            abort(500);
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
    public function edit($id)
    {
        $settingEdit = $this->setting->find($id);
        return view('admin.setting.edit',compact('settingEdit'));
    }
    public function update($id, Request $request)
    {
        try {
            $this->setting->find($id)->update([
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
            ]);
            return redirect()->route('settings.index');
        }
        catch (\Exception $exception)
        {
            abort(500);
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->setting);
    }
}
