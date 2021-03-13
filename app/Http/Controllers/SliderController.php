<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $sliders = $this->slider->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create()
    {
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'description' => html_entity_decode($request->description),
            ];
            $dataUpload = $this->storageTraitUpload($request,'image_path','slider');
            if (!empty($dataUpload) )
            {
                $data['image_path'] = $dataUpload['file_path'];
                $data['image_name'] = $dataUpload['file_name'];
            }
            $this->slider->create($data);
            return redirect()->route('sliders.index');

        }
        catch (\Exception $exception)
        {
            abort(500);
        }
    }
    public function edit($id)
    {
        $sliderEdit = $this->slider->find($id);
        return view('admin.slider.edit',compact('sliderEdit'));
    }
    public function update(Request $request,$id)
    {
        try {
            $data = [
                'name' => $request->name,
                'description' => html_entity_decode($request->description)
            ];
            $dataUpload = $this->storageTraitUpload($request,'image_path','slider');
            if (!empty($dataUpload))
            {
                $data['image_path'] = $dataUpload['file_path'];
                $data['image_name'] = $dataUpload['file_name'];
            }
            $this->slider->find($id)->update($data);
            return redirect()->route('sliders.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->slider);
    }
}
