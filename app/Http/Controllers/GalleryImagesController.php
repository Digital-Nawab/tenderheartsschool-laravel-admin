<?php

namespace App\Http\Controllers;

use App\Models\GalleryImages;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class GalleryImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $branch_id = null, $category_id = null)

    {

        // Initialize variables
        $title =  'Add Gallery Category Image';
        $data = GalleryImages::where(['branch_id' => $branch_id,'category_id' => $category_id])->orderBy('id', 'desc')->get();
        if ($request->isMethod('post')) {
            $rules = [
                'title' => 'required',
                'branch_id' => 'required',
                'category_id' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ];
            $customMessages = [
                'branch_id.required' => 'The Gallery Service is required.',
                'branch_id.exists' => 'The selected product does not exist.',
                'category_id.required' => 'The Gallery Category is required.',

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
                $path = 'assets/images/gallery-images/';

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
                    GalleryImages::create([
                        'title' => $request->title,
                        'branch_id' => $request->branch_id,
                        'category_id' => $request->category_id,
                        'image' => $path . $filename,
                    ]);
                }
            }
            return redirect()->back()->with('success_msg', 'Gallery images uploaded successfully!');
        }
        return view('gallery-category.index', compact('title', 'data','branch_id','category_id'));
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = GalleryImages::find($id);
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
