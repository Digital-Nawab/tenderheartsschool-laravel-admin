<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Career;
use App\Models\Branch;
use App\Models\Certificate;
use App\Models\GalleryCategory;
use App\Models\GalleryImages;
use App\Models\MetatagSeo;
use App\Models\BranchAbout;
use App\Models\Result;
use App\Models\News;
use App\Models\notice;
use App\Models\Slider;
use App\Mail\Enquirymail;
use App\Mail\BranchEnquirymail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function enquiry(Request $request){
        $rules = [
            'parent_name' => "required|string|max:255",
            'phone' => "required|digits_between:10,15",
            'dob' => "required|date",
            'child_name' => "required|string|max:255",
        ];

        $customMsg = [
            'parent_name.required' => 'Parent Name is required.',
            'parent_name.string' => 'Parent Name must be a valid text.',
            'phone.required' => 'Phone Number is required.',
            'phone.digits_between' => 'Phone Number must be between 10 to 15 digits.',
            'dob.required' => 'Date of Birth is required.',
            'dob.date' => 'Date of Birth must be a valid date.',
            'child_name.required' => 'Child Name is required.',
            'child_name.string' => 'Child Name must be a valid text.',
        ];

        $validator = Validator::make($request->all(),$rules, $customMsg);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => "Validation Error",
                'errors' => $validator->errors()->all(),
            ], 401);
        }
        $data =  [
            'parent_name' => $request->parent_name,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'child_name' => $request->child_name,
            'message' => $request->message,
        ];
        Contact::create($data);
        Mail::to('presidenthslko@gmail.com')
            ->cc([
                'tenderheartskrd@gmail.com',
            ])
            ->bcc([
                'adwordsdigitalnawab@gmail.com',
                'satyalaravel2023@gmail.com'
            ])
            ->send(new EnquiryMail($data));
        return response()->json([
            'status'=> true,
            'success'=> 'Enquiry send successfully!'
        ], 200);
    }

    public function career(Request $request){
        $rules = [
            'first_name' => "required|string|max:255",
            'last_name' => "required|string|max:255",
            'subject' => "required|string|max:255",
            'phone' => "required|digits_between:10,15",
            'email' => "required|email|max:255",
            'resume' => "required|mimes:doc,docx,pdf|max:2048",
            'message' => "nullable|string|max:255",

        ];

        $customMsg = [
            'first_name.required' => 'First Name is required.',
            'first_name.string' => 'First Name must be a valid text.',
            'last_name.required' => 'Last Name is required.',
            'last_name.string' => 'Last Name must be a valid text.',
            'subject.required' => 'Apply job for is required.',
            'subject.string' => 'Apply job for must be a valid text.',
            'phone.required' => 'Phone Number is required.',
            'phone.digits_between' => 'Phone Number must be between 10 to 15 digits.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'resume.required' => 'Resume is required.',
            'resume.mimes' => 'Resume must be a file of type: doc, docx, pdf.',
            'resume.max' => 'Resume must not exceed 2MB.',
        ];

        $validator = Validator::make($request->all(),$rules, $customMsg);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => "Validation Error",
                'errors' => $validator->errors()->all(),
            ], 401);
        }
        $data =  [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ];
        if ($request->hasFile('resume')) {
            $path = 'assets/resumes/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $uploadedFile = $request->file('resume');
            // Allow only document types
            $allowedExtensions = ['pdf', 'doc', 'docx', 'rtf'];
            $ext = strtolower($uploadedFile->getClientOriginalExtension());
            if (!in_array($ext, $allowedExtensions)) {
                return back()->withErrors(['resume' => 'Invalid file type. Please upload a PDF, DOC, DOCX, or RTF resume.']);
            }
            $filename = uniqid() . '.' . $ext;
            $uploadedFile->move($path, $filename);
            $data['resume'] = $path . $filename;
        }

        Career::create($data);
        Mail::to('presidenthslko@gmail.com')
            ->cc([
                'tenderheartskrd@gmail.com',
            ])
            ->bcc([
                'adwordsdigitalnawab@gmail.com',
                'satyalaravel2023@gmail.com'
            ])
            ->send(new BranchEnquirymail($data));
        return response()->json([
            'status'=> true,
            'success'=> 'Enquiry send successfully!'
        ], 200);
    }

    public function branch(){
        $branch = Branch::all();
        return response()->json($branch);
    }
    
    
    public function gallery()
{
    $branches = Branch::select('title', 'id', 'slug_url', 'image')
        ->where('is_active', 1)
        ->with(['categories:id,branch_id,title,url,image'])
        ->get();

    return response()->json($branches);
}
    
    public function galleryCategory($url)
        {
        $gallery = Branch::where('slug_url', $url)->first();
                //  return response()->json($category);
            if(!empty($gallery)){
                $category = GalleryCategory::where(['branch_id'=>$gallery->id])->get();
                return response()->json($category);
               }else{
                return response()->json(['message' => 'Gallery Category not found'], 404);
            }
        }

    public function Certificate($serialNumber)
    {
        // Use proper naming conventions (camelCase, meaningful variables)
        $certificate = Certificate::select('serial', 'image')
            ->where(['serial'=> trim($serialNumber)])
            ->first();

        // Check if found
        if ($certificate) {
            return response()->json($certificate, 200);
        }

        // Return standardized error JSON
        return response()->json([
            'message' => 'TC Certificate not found',
            'status'  => false,
        ], 404);
    }


    public function metaSeo($url = null)
        {
            if(!empty($meta)){
                $meta = MetatagSeo::Select('url', 'title', 'description', 'keyword', 'image')->where(['url'=> $url ,'is_active'=> 1])->orderBy('id', 'desc')->first();
            }else{
                $meta = MetatagSeo::Select('url', 'title', 'description', 'keyword', 'image')->where(['is_active'=> 1 ])->orderBy('id', 'desc')->get();
            }
        
            //  return response()->json($category);
            if(!empty($meta)){
                
                return response()->json($meta);
               }else{
                return response()->json(['message' => 'Meta tags  not found'], 404);
            }
        }

    public function categoryGallery($url){
        $category = GalleryCategory::where('url', $url)->first();
        //  return response()->json($category);
       if(!empty($category)){
           $image = GalleryImages::Select('title', 'image')->where(['branch_id'=>$category->branch_id, 'category_id'=>$category->id ])->get();
        return response()->json($image);
       }else{
        return response()->json(['message' => 'Gallery Category not found'], 404);
       }
    }


    public function branchAbout($url){
        $branch = Branch::where('slug_url', $url)->first();
       if(!empty($branch)){
           $about = BranchAbout::where('branch_id', $branch->id)->first();
        return response()->json($about);
       }else{
        return response()->json(['message' => 'Branch not found'], 404);
       }
    }
    
     public function branchFacilities($id){
        $branch = Branch::where('id', $id)->first();
       if(!empty($branch)){
           $facilities = BranchFacilities::where('branch_id', $branch->id)->get();
        return response()->json($facilities);
       }else{
        return response()->json(['message' => 'Branch not found'], 404);
       }
    }
    
    

    public function result(){
        $result = Result::all();
        return response()->json($result);
    }

    public function news(){
        $news = News::all();
        return response()->json($news);
    }

    public function notice(){
        $notice = notice::all();
        return response()->json($notice);
    }
    public function slider(){
        $slider = Slider::all();
        return response()->json($slider);
    }


}
