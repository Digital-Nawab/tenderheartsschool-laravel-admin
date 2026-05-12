<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title= 'Contact List';
        $data = Contact::where('is_active', 1)->paginate(50);
        return view('enquiry.index', compact('title', 'data'));
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
                'parent_name'    => 'required|string|max:50',
                'mobile'  => 'required|string|max:13|min:10',
                'dob'   => 'required|string|max:255', // Email field added
                'child_name' => 'nullable|string|max:255',
                'message'    => 'nullable|string|max:255', // Make 'city' optional
            ];

            $customMessages = [
                'parent_name.required'    => 'The parent name is required.',
                'parent_name.string'      => 'The parent name must be a string.',
                'parent_name.max'         => 'The parent name must not exceed 50 characters.',
                'mobile.required'  => 'The contact mobile number is required.',
                'mobile.string'    => 'The mobile number must be a string.',
                'mobile.max'       => 'The mobile number must not exceed 13 characters.',
                'mobile.min'       => 'The mobile number must be at least 10 characters.',
                'dob.email'      => 'The dob must be a valid email address.',
                'dob.max'        => 'The dob must not exceed 255 characters.',
                'child_name.string'   => 'The child name must be a string.',
                'child_name.max'      => 'The child name must not exceed 255 characters.',
                'message.string'      => 'The city must be a string.',
                'message.max'         => 'The city must not exceed 255 characters.',
            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data['is_active'] = 1;
            Contact::create($data);
            return redirect()->back()->with('success_msg', 'Contact created successfully');
        }


    }



    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            // Handle case where the contact is not found
            return response()->json(['message' => 'Contact not found'], 404);
        }
        // Toggle the is_active field
        $contact->is_active = $contact->is_active == 1 ? 2 : 1;

        // Save the updated package
        $contact->save();

        return response()->json(['message' => 'Contact Staus updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return redirect()->back()->with('success_msg', 'Contact deleted successfully');
        }
        return redirect()->back()->with('error_msg', 'Contact not found');
    }
}
