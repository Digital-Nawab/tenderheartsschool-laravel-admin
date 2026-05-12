<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024',
                'serial'     => 'required|max:255',
            ];

            $customMessages = [
                'image.required' => 'The slider image is required.',
                'serial.required' => 'The serial  Number is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The slider image must be a file of type: jpeg, jpg, png, webp.',
                'image.max' => 'The slider image size must not exceed 2MB.',
                'serial.max' => 'The serial may not be greater than 255 characters.',
            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = strtolower($file->getClientOriginalExtension());
                $path = 'assets/images/result/';

                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                // 📘 If file is a PDF
                if ($extension === 'pdf') {
                    $filename = uniqid() . '.pdf';
                    $file->move($path, $filename);
                    $data['image'] = $path . $filename;
                }
                // 🖼️ If file is an image (jpeg/png/jpg/webp)
                else {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($file);
                    // $image->resize(1900, 800); // optional
                    $image->encode(new WebpEncoder(quality: 65));
                    $filename = uniqid() . '.webp';
                    $image->save($path . $filename);
                    $data['image'] = $path . $filename;
                }
            }


            Certificate::create($data);
            return redirect()->back()->with('success_msg', 'Certificate created successfully');
        }
        $title= 'Add Result';
        $data = Certificate::orderBy('id', 'DESC')->get();
        //return $data;
        return view('certificate.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function destroy($id)
    {
        $data = Certificate::find($id);
        if($data){
            if(!empty($data->image) && file_exists(public_path($data->image))){
                unlink(public_path($data->image));
            }
            $data->delete();
            return redirect()->back()->with('success_msg', 'Certificate deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Certificate not found');
    }
}
