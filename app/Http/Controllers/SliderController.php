<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function AddSlider(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'alt_text'     => 'nullable|string|max:255',
            ];

            $customMessages = [
                'slider_image.required' => 'The slider image is required.',
                'slider_image.image' => 'The file must be an image.',
                'slider_image.mimes' => 'The slider image must be a file of type: jpeg, jpg, png, webp.',
                'slider_image.max' => 'The slider image size must not exceed 2MB.',
                'mobile_image.image' => 'The mobile image must be an image.',
                'mobile_image.mimes' => 'The mobile image must be a file of type: jpeg, jpg, png, webp.',
                'mobile_image.max' => 'The mobile image size must not exceed 2MB.',
                'alt_text.max' => 'The alt text may not be greater than 255 characters.',
            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($request->hasFile('slider_image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/slider/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('slider_image');
                $image = $manager->read($uploadedImage);
                $image->resize(1900, 800);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['slider_image'] = $path.$filename;
            }
            if($request->hasFile('mobile_image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/slider/banner';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('mobile_image');
                $image = $manager->read($uploadedImage);
                $image->resize(500, 500);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['mobile_image'] = $path.$filename;
            }
            Slider::create($data);
            return redirect()->back()->with('success_msg', 'Slider created successfully');
        }
        $title= 'Add Slider';
        $data = Slider::where('is_active', 1)->get();
        //return $data;
        return view('slider.slider', compact('title', 'data'));
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::find($id);
        if($slider){
            if(!empty($slider->slider_image) && file_exists(public_path($slider->slider_image))){
                unlink(public_path($slider->slider_image));
            }
            if(!empty($slider->mobile_image) && file_exists(public_path($slider->mobile_image))){
                unlink(public_path($slider->mobile_image));
            }
            $slider->delete();
            return redirect()->back()->with('success_msg', 'Slider deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Slider not found');
    }
}
