<?php

namespace App\Http\Controllers;

use App\Models\BranchAbout;
use App\Models\BranchFacilities;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class BranchFacilitiesController extends Controller
{
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
                'image'             =>  'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'description'       =>  'nullable|string',
            ];

            // Custom error messages
            $customMessages = [
                'branch_id.required'        => 'The branch id is required.',
                'title.required'            => 'The title is required.',
                'image.required'            => 'The image is required.',
                'image.image'               => 'The file must be an image.',
                'image.mimes'               => 'The image must be a file of type: jpeg, jpg, png, webp.',
                'image.max'                 => 'The image may not be greater than 2MB.',
            ];

            // Validate the request
            $validator = Validator::make($data, $rules, $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/facilities/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('image');
                $image = $manager->read($uploadedImage);
                $image->resize(430, 330);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['image'] = $path.$filename;
            }

            // Save the course details
            BranchFacilities::create($data);

            return redirect()->back()->with('success_msg', 'Branch Facilities created successfully.');
        }

        $title = 'Add Branch Facilities Details';
        $data = BranchFacilities::where(['branch_id' => $branchId])->get();

        return view('branch.branch-facilities', compact('title', 'data', 'id'));
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
                'title'             =>  'required|string|max:255',
                'description'       =>  'nullable|string',
            ];

            // Custom error messages
            $customMessages = [
                'title.required'            => 'The title is required.',

            ];

            if($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/facilities/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('image');
                $image = $manager->read($uploadedImage);
                $image->resize(430, 330);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['image'] = $path.$filename;
            }

            // Validate the request
            $validator = Validator::make($data, $rules, $customMessages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Find the course by ID
            $Detail = BranchFacilities::find($id);
            if (!$Detail) {
                return redirect()->back()->with('error_msg', 'Branch Facilities  not found.');
            }
            // Update the course details
            $Detail->update($data);
            return redirect()->back()->with('success_msg', 'Branch Facilities updated successfully.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $meta = BranchFacilities::find($id);
        if (!$meta) {
            // Handle case where the  is not found
            return response()->json(['message' => 'Branch Facilities  not found'], 404);
        }
        // Toggle the is_active field
        $meta->is_active = $meta->is_active == 1 ? 2 : 1;
        // Save the updated package
        $meta->save();
        return response()->json(['message' => 'Branch Facilities Status updated successfully']);
    }
}
