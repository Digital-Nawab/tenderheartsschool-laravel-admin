<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\Branch;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Add Gallery Category';
        $data = GalleryCategory::get();
        //return $gallery;
        return view('gallery-category.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id = null)

    {

        // Initialize variables
        $title = $id ? 'Edit Gallery Category' : 'Add Gallery Category';
        $gallery = $id ? GalleryCategory::findOrFail($id) : new GalleryCategory;
        $services = Branch::where('is_active', 1)->get();
        $data = GalleryCategory::all();
        if ($request->isMethod('post')) {
            $rules = [
                'title' => 'required',
                'url' => 'required',
                'branch_id' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ];
            $customMessages = [
                'branch_id.required' => 'The Branch  is required.',
                'url.required' => 'TheCategory URL  is required.',
                'image.required' => 'The gallery image is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
                'image.max' => 'The image may not be greater than 2MB.',
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/gallery-category/';

                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                foreach ($request->file('image') as $uploadedImage) {
                    $image = $manager->read($uploadedImage);
                    // $image->resize(1500, 1500);
                    $image->encode(new WebpEncoder(quality: 65));

                    $filename = uniqid() . '.webp';
                    $image->save($path . $filename);

                    // Save the image path for each upload
                    GalleryCategory::create([
                        'title' => $request->title,
                        'url' => $request->url,
                        'branch_id' => $request->branch_id,
                        'image' => $path . $filename,
                    ]);
                }
            }
            return redirect()->back()->with('success_msg', 'Gallery Category images uploaded successfully!');
        }
        return view('gallery-category.create', compact('title', 'gallery', 'services', 'data'));
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = GalleryCategory::find($id);
        if($gallery){
            if(!empty($gallery->image) && file_exists(public_path($gallery->image))){
                unlink(public_path($gallery->image));
            }
            $gallery->delete();
            return redirect()->back()->with('success_msg', 'Gallery image deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Gallery image not found');
    }
}
