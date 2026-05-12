<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
                'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
                'title'     => 'nullable|string|max:255',
            ];

            $customMessages = [
                'image.required' => 'The News image is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The News image must be a file of type: jpeg, jpg, png, webp.',
                'image.max' => 'The News image size must not exceed 2MB.',
                'title.max' => 'The alt text may not be greater than 255 characters.',
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/result/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('image');
                $image = $manager->read($uploadedImage);
//                $image->resize(1900, 800);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['image'] = $path.$filename;
            }

            News::create($data);
            return redirect()->back()->with('success_msg', 'News created successfully');
        }
        $title= 'Add News';
        $data = News::orderBy('id', 'desc')->get();
        //return $data;
        return view('news.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function destroy($id)
    {
        $slider = News::find($id);
        if($slider){
            if(!empty($slider->image) && file_exists(public_path($slider->image))){
                unlink(public_path($slider->image));
            }

            $slider->delete();
            return redirect()->back()->with('success_msg', 'Result deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Result not found');
    }
}
