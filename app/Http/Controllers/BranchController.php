<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index()
    {
        $branch = Branch::get();
        return view('branch.index', compact('branch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id = null)
    {
        if($id == ""){
            $title = "Add Branch";
            $branch = new Branch();
            $message = "Branch added successfully";
        }else{
            $title = "Update Branch";
            $branch = Branch::find($id);
            $message = "Branch updated successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title'         => 'required|string|max:225,' . $id,
                'heading'         => 'nullable|string|max:255',
                'subheading'         => 'nullable|string|max:255|',
                'slug_url'      => 'required|string|max:255',
                'image'         => $id ? 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048' : 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'banner'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024',
                'mobile_banner' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024',
                'description'   => 'nullable|string|max:255',
                'about_title'   => 'required|string|max:255',
                'about_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024',
                'about_heading'   => 'required|string|max:255',
                'about_subheading'   => 'required|string|max:255',
                'about_description'   => 'required|string',
                'ths'           => 'nullable|string|max:255',
                'learn'         => 'nullable|string|max:255',
                'environment'   => 'nullable|string|max:255',
                'is_front'      => 'required|in:no,yes',

            ];
            $customMessages = [
                'title.required' => 'The Branch name is required.',
                'title.unique' => 'The Branch name already exists. Please choose a different name.',
                'slug_url.required' => 'The Branch URL is required.',
                'slug_url.unique' => 'The Branch URL already exists. Please choose a different name.',
                'image.required' => 'The Branch image is required.',
                'banner.required' => 'The Branch banner is required.',
                'mobile_banner.required' => 'The Branch mobile banner is required.',
                'description.required' => 'The Branch description is required.',
                'about_title.required' => 'The Branch about title is required.',
                'about_heading.required' => 'The Branch about heading is required.',
                'about_subheading.required' => 'The Branch about subheading is required.',
                'about_description.required' => 'The Branch about description is required.',
                'is_front.required' => 'The Branch front selection is required.',
                'is_front.in' => 'The Branch front selection is invalid.',


            ];
            $validator = Validator::make($data, $rules, $customMessages);

            if($validator->fails()){
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

            if($request->hasFile('about_image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/branch/about';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('about_image');
                $image = $manager->read($uploadedImage);
                $image->resize(640, 430);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['about_image'] = $path.$filename;
            }
            if ($id == "") {
                Branch::create($data);
            } else {
                $branch->update($data);
            }
            return redirect()->back()->with('success_msg', $message);
        }
        return view('branch.create', compact('title', 'branch'));
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        if($branch){
            if(!empty($branch->image) && file_exists(public_path($branch->image))){
                unlink(public_path($branch->image));
            }
            if(!empty($branch->banner) && file_exists(public_path($branch->banner))){
                unlink(public_path($branch->banner));
            }
            if(!empty($branch->mobile_banner) && file_exists(public_path($branch->mobile_banner))){
                unlink(public_path($branch->mobile_banner));
            }
            $branch->delete();
            return redirect()->back()->with('success_msg', 'Branch deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Branch not found');
    }
}
