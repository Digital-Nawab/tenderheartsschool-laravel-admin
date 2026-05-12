<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title= 'Career List';
        $data = Career::where('is_active', 1)->orderBy('id', 'desc')->paginate(30);
        return view('career.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
                'first_name'    => 'required|string|max:50',
                'last_name'    => 'required|string|max:50',
                'email'  => 'required|email|max:255',
                'mobile'  => 'required|string|max:13|min:10',
                'subject'   => 'required||max:255', // Email field added
                'resume' => 'nullable|string|max:255',
                'message'    => 'nullable|string|max:255', // Make 'city' optional
            ];

            $customMessages = [
                'first_name.required'    => 'The first name is required.',
                'first_name.string'      => 'The first name must be a string.',
                'first_name.max'         => 'The first name must not exceed 50 characters.',
                'last_name.required'    => 'The last name is required.',
                'last_name.string'      => 'The last name must be a string.',
                'last_name.max'         => 'The last name must not exceed 50 characters.',
                'email.required'  => 'The contact email is required.',
                'email.email'    => 'The email must be a valid email address.',
                'email.max'       => 'The email must not exceed 255 characters.',
                'mobile.required'  => 'The contact mobile number is required.',
                'mobile.string'    => 'The mobile number must be a string.',
                'mobile.max'       => 'The mobile number must not exceed 13 characters.',
                'mobile.min'       => 'The mobile number must be at least 10 characters.',
                'subject.required'  => 'The subject is required.',
                'subject.string'    => 'The subject must be a string.',
                'subject.max'       => 'The subject must not exceed 255 characters.',
                'resume.string'    => 'The resume must be a string.',
                'resume.max'       => 'The resume must not exceed 255 characters.',
                'message.string'      => 'The message must be a string.',
                'message.max'         => 'The message must not exceed 255 characters.',
            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data['is_active'] = 1;
            Career::create($data);
            return redirect()->back()->with('success_msg', 'Contact created successfully');
        }


    }



    /**
     * Update the specified resource in storage.
     */
   public function update($id)
{
    $career = Career::find($id);
    if (!$career) {
        return response()->json(['message' => 'Career not found'], 404);
    }

    // Toggle: 1 -> 2, 2 -> 1
    $career->is_active = $career->is_active == 1 ? 2 : 1;
    $career->save();

    return response()->json([
        'message' => 'Career status updated successfully',
        'is_active' => (int) $career->is_active,
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Career::find($id);
        if ($contact) {
            $contact->delete();
            return redirect()->back()->with('success_msg', 'Career deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Career not found');
    }
}
