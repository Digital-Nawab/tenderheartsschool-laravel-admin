<?php

namespace App\Http\Controllers;

use App\Models\BranchAbout;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class BranchAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $branchId = base64_decode($id);

        if ($request->isMethod('POST')) {
            $data = $request->all();
            $data['branch_id'] = $branchId;

            // Validation rules
            $rules = [
                'branch_id'         =>  'required|string|max:255',
                'title'             =>  'required|string|max:255',
                'heading'           =>  'required|string|max:255',
                'subheading'        =>  'required|string|max:255',
                'image'             =>  'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'banner'            =>  'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'mobile_banner'     =>  'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'description'       =>  'nullable|string',
                'long_description'  =>  'nullable|string',
                'vision'            =>  'nullable|string',
                'mission'           =>  'nullable|string',
                'value'             =>  'nullable|string',
            ];

            // Custom error messages
            $customMessages = [
                'branch_id.required'        => 'The branch id is required.',
                'title.required'            => 'The title is required.',
                'heading.required'          => 'The heading is required.',
                'subheading.required'       => 'The subheading is required.',
                'image.required'            => 'The image is required.',
                'image.image'               => 'The file must be an image.',
                'image.mimes'               => 'The image must be a file of type: jpeg, jpg, png, webp.',
                'image.max'                 => 'The image may not be greater than 2MB.',
                'banner.required'           => 'The banner is required.',
                'banner.image'              => 'The file must be an image.',
                'banner.mimes'              => 'The banner must be a file of type: jpeg, jpg, png, webp.',
                'banner.max'                => 'The banner may not be greater than 2MB.',
                'mobile_banner.required'    => 'The mobile banner is required.',
                'mobile_banner.image'       => 'The file must be an image.',
                'mobile_banner.mimes'       => 'The mobile banner must be a file of type: jpeg, jpg, png, webp.',
                'mobile_banner.max'         => 'The mobile banner may not be greater than 2MB.',
                'description.required'      => 'The description is required.',
                'long_description.required' => 'The long description is required.',
                'vision.required'           => 'The vision is required.',
                'mission.required'          => 'The mission is required.',
                'value.required'            => 'The value is required.',


            ];

            // Validate the request
            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('image');
                $image = $manager->read($uploadedImage);
                $image->resize(419, 283);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['image'] = $path.$filename;
            }
            if($request->hasFile('banner')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/banner';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('banner');
                $image = $manager->read($uploadedImage);
                $image->resize(1920, 480);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['banner'] = $path.$filename;
            }

            if($request->hasFile('mobile_banner')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/mobile';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('mobile_banner');
                $image = $manager->read($uploadedImage);
                $image->resize(500, 500);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['mobile_banner'] = $path.$filename;
            }
//            echo '<pre>';print_r($data);exit();
            // Save the course details
            BranchAbout::create($data);

            return redirect()->back()->with('success_msg', 'Sub Service details created successfully.');
        }

        $title = 'Add Sub Services Details';
        $data = BranchAbout::where(['branch_id' => $branchId, 'is_active' => 1])->get();

        return view('branch.about-branch', compact('title', 'data', 'id'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            if (!isset($data['id']) || empty($data['id'])) {
                return redirect()->back()->with('error_msg', 'Invalid Course ID.');
            }
            $id = base64_decode($data['id']);

            if (!$id || !is_numeric($id)) {
                return redirect()->back()->with('error_msg', 'Invalid Course ID.');
            }
            // Validation rules
            $rules = [
                'branch_id'    =>  'required|string|max:255',
                'title'         =>  'required|string|max:255',
                'heading'         =>  'required|string|max:255',
                'subheading'         =>  'required|string|max:255',
                'image'         =>  'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                'banner'         =>  'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                'mobile_banner'         =>  'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                'description'   =>  'nullable|string',
                'long_description'   =>  'nullable|string',
                'vision'   =>  'nullable|string|max:255',
                'mission'   =>  'nullable|string|max:255',
                'value'   =>  'nullable|string|max:255',
            ];

            // Custom error messages
            $customMessages = [
                'branch_id.required' => 'The branch id is required.',
                'title.required' => 'The title is required.',
                'heading.required' => 'The heading is required.',
                'subheading.required' => 'The subheading is required.',
                'image.required' => 'The image is required.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, webp.',
                'image.max' => 'The image may not be greater than 2MB.',
                'banner.required' => 'The banner is required.',
                'banner.image' => 'The file must be an image.',
                'banner.mimes' => 'The banner must be a file of type: jpeg, jpg, png, webp.',
                'banner.max' => 'The banner may not be greater than 2MB.',
                'mobile_banner.required' => 'The mobile banner is required.',
                'mobile_banner.image' => 'The file must be an image.',
                'mobile_banner.mimes' => 'The mobile banner must be a file of type: jpeg, jpg, png, webp.',
                'mobile_banner.max' => 'The mobile banner may not be greater than 2MB.',
                'description.required' => 'The description is required.',
                'long_description.required' => 'The long description is required.',
                'vision.required' => 'The vision is required.',
                'mission.required' => 'The mission is required.',
                'value.required' => 'The value is required.',
            ];

            if($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('image');
                $image = $manager->read($uploadedImage);
                $image->resize(419, 283);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['image'] = $path.$filename;
            }
            if($request->hasFile('banner')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/banner';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('banner');
                $image = $manager->read($uploadedImage);
                $image->resize(1920, 480);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['banner'] = $path.$filename;
            }

            if($request->hasFile('mobile_banner')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/mobile';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('mobile_banner');
                $image = $manager->read($uploadedImage);
                $image->resize(500, 500);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['mobile_banner'] = $path.$filename;
            }

            echo '<pre>';print_r($data);exit();
            // Validate the request
            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Find the course by ID
            $Detail = BranchAbout::find($id);
            if (!$Detail) {
                return redirect()->back()->with('error_msg', 'Branch About details not found.');
            }
            // Update the course details
            $Detail->update($data);
            return redirect()->back()->with('success_msg', 'Branch About details updated successfully.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $meta = BranchAbout::find($id);
        if (!$meta) {
            // Handle case where the  is not found
            return response()->json(['message' => 'Branch About  not found'], 404);
        }
        // Toggle the is_active field
        $meta->is_active = $meta->is_active == 1 ? 2 : 1;
        // Save the updated package
        $meta->save();
        return response()->json(['message' => 'Branch About Detail Status updated successfully']);
    }
}
