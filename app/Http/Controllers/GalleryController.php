<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Branch;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::get();
        //return $gallery;
        return view('gallery.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id = null)

    {

        // Initialize variables
        $title = $id ? 'Edit Gallery' : 'Add Gallery';
        $gallery = $id ? Gallery::findOrFail($id) : new Gallery;
        $services = Branch::where('is_active', 1)->get();
        $data = Gallery::all();
        if ($request->isMethod('post')) {
            $rules = [
                'branch_id' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ];
            $customMessages = [
                'branch_id.required' => 'The Gallery Service is required.',
                'branch_id.exists' => 'The selected product does not exist.',
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
                $path = 'assets/images/gallery/';

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
                    Gallery::create([
                        'title' => $request->title,
                        'branch_id' => $request->service_id,
                        'image' => $path . $filename,
                        'is_front' => $request->is_front,
                        'is_active' => 1,
                    ]);
                }
            }
            return redirect()->back()->with('success_msg', 'Gallery images uploaded successfully!');
        }
        return view('gallery.create', compact('title', 'gallery', 'services', 'data'));
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
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
