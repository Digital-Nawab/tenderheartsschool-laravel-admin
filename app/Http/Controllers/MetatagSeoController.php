<?php

namespace App\Http\Controllers;

use App\Models\MetatagSeo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MetatagSeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
                'url' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:200',
                'title'     => 'required|string|max:255',
                'description'     => 'required|string|max:255',
                'keywords'     => 'nullable|string|max:255',

            ];

            $customMessages = [
                'url.required' => 'The Meta url is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The slider image must be a file of type: jpeg, jpg, png, webp.',
                'image.max' => 'The slider image size must not exceed 200kb.',
                'title.max' => 'The Meta title text may not be greater than 255 characters.',
                'title.required' => 'The Meta title  is required.',
                'description.max' => 'The Meta description text may not be greater than 255 characters.',
                'description.required' => 'The Meta description  is required.',
                'keywords.max' => 'The Meta keywords text may not be greater than 255 characters.',


            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/meta/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('image');
                $image = $manager->read($uploadedImage);
                $image->resize(900, 1600);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['image'] = $path.$filename;
            }


            MetatagSeo::create($data);
            return redirect()->back()->with('success_msg', 'Meta Tags Seo created successfully');
        }
        $title= 'Add Meta Tags Seo';
        $data = MetatagSeo::get();
//        echo '<pre>'; print_r($data);exit;
        return view('meta-seo.tag.create', compact('title', 'data'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $meta = MetatagSeo::find($id);
        if (!$meta) {
            // Handle case where the  is not found
            return response()->json(['message' => 'Meta Tags Seo not found'], 404);
        }
        // Toggle the is_active field
        $meta->is_active = $meta->is_active == 1 ? 2 : 1;

        // Save the updated package
        $meta->save();

        return response()->json(['message' => 'Meta Tags Seo Staus updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $meta = MetatagSeo::find($id);
        if ($meta) {
            if (!empty($meta->image) && file_exists(public_path($meta->image))) {
                unlink(public_path($meta->image));
            }
            $meta->delete();
            return redirect()->back()->with('success_msg', 'Meta Tags Seo deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Meta Tags Seo not found');
    }
}
