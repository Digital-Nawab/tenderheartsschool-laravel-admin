<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\notice;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
                'title'         => 'nullable|string|max:255',
                'url'           => 'required',
                'description'   => 'required',
                'date'          => 'required',
            ];

            $customMessages = [
                'title.required'        => 'The title is required.',
                'title.max'             => 'The title text may not be greater than 255 characters.',
                'url.required'          => 'The url is required.',
                'description.required'  => 'The description is required.',
                'date.required'         => 'The date is required.',

            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
//            if($request->hasFile('image')) {
//                $manager = new ImageManager(new Driver());
//                $path = 'assets/images/result/';
//                if (!is_dir($path)) {
//                    mkdir($path, 0755, true);
//                }
//                $uploadedImage = $request->file('image');
//                $image = $manager->read($uploadedImage);
//                $image->encode(new WebpEncoder(quality: 65));
//                $filename = uniqid() . '.' .'webp';
//                $image->save($path.$filename);
//                $data['image'] = $path.$filename;
//            }

            notice::create($data);
            return redirect()->back()->with('success_msg', 'News created successfully');
        }
        $title= 'Add Notice';
        $data = notice::orderBy('id', 'desc')->get();
        //return $data;
        return view('notice.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function destroy($id)
    {
        $slider = notice::find($id);
        if($slider){
            /*if(!empty($slider->image) && file_exists(public_path($slider->image))){
                unlink(public_path($slider->image));
            }*/

            $slider->delete();
            return redirect()->back()->with('success_msg', 'notice deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'notice not found');
    }
}
