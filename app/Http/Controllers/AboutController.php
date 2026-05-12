<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::get();
        return view('about.index', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request, $id = null)
    {
        $title = $id ? "Update About" : "Add About";
        $about = $id ? About::find($id) : new About();
        $message = $id ? "About updated successfully" : "About added successfully";

        if ($request->isMethod('post')) {
            $data = $request->all();

            // Dynamic validation for uniqueness
            $rules = [
                'heading' => 'required|string|max:255|unique:abouts,heading' . ($id ? ",$id" : ''),
                'is_index' => 'required|in:Y,N',
                'description' => 'required',
            ];
            $customMessages = [
                'heading.required' => 'The About heading is required.',
                'heading.unique' => 'The heading name already exists. Please choose a different name.',
                'is_index.required' => 'The About View Index selection is required.',
                'description.required' => 'The About description is required.',
            ];

            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Handle image upload
//            if($request->hasFile('image')) {
//                $manager = new ImageManager(new Driver());
//                $path = 'assets/images/about/';
//                if (!is_dir($path)) {
//                    mkdir($path, 0755, true);
//                }
//                $uploadedImage = $request->file('image');
//                $image = $manager->read($uploadedImage);
//                $image->resize(1080, 1080);
//                $image->encode(new WebpEncoder(quality: 65));
//                $filename = uniqid() . '.' .'webp';
//                $image->save($path.$filename);
//                $data['image'] = $path.$filename;
//            }

            // Handle file upload
            // Handle file upload
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $mimeType = $uploadedFile->getMimeType();

                if (str_starts_with($mimeType, 'image/')) {
                    // Handle image upload
                    $manager = new ImageManager(new Driver());
                    $path = 'assets/images/about/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $image = $manager->read($uploadedFile);
                    $image->resize(1080, 1080);
                    $image->encode(new WebpEncoder(quality: 65));
                    $filename = uniqid() . '.' . 'webp';
                    $image->save($path . $filename);
                    $data['file'] = $path . $filename;
                } elseif (str_starts_with($mimeType, 'video/')) {
                    // Handle video upload
                    $path = 'assets/videos/about/';
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $filename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                    $uploadedFile->move($path, $filename);
                    $data['file'] = $path . $filename;
                } else {
                    return redirect()->back()->withErrors(['file' => 'Invalid file type. Only images and videos are allowed.'])->withInput();
                }
            }


            // Save or update the `About` model
            $about->title = $data['title'];
            $about->heading = $data['heading'];
            $about->is_index = $data['is_index'];
            $about->description = $data['description'];
            if (isset($data['file'])) {
                $about->image = $data['file'];
            }
            $about->is_active = 1;
            $about->save();

            return redirect()->back()->with('success', $message);
        }

        return view('about.create', compact('title', 'about'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $about = About::find($id);
        if($about){
            if(!empty($about->image) && file_exists(public_path($about->image))){
                unlink(public_path($about->image));
            }
            $about->delete();
            return redirect()->back()->with('success', 'About deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'About not found');
    }
}
