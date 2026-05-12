<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::post('/enquiry', [EnquiryController::class,'enquiry']);
//Route::post('/branch-enquiry', [EnquiryController::class,'BranchEnquiry']);
Route::get('/branch', [ApiController::class,'branch']);
Route::post('/enquiry', [ApiController::class,'enquiry']);
Route::post('/career', [ApiController::class,'career']);
Route::get('/branch-about/{url}', [ApiController::class,'branchAbout']);
Route::get('/branch-facilities/{id}', [ApiController::class,'branchFacilities']);
Route::get('/student-tc/{serial}', [ApiController::class,'Certificate']);
Route::get('/result', [ApiController::class,'result']);

Route::get('/gallery', [ApiController::class,'gallery']);
Route::get('/gallery-category/{url}', [ApiController::class,'galleryCategory']);
Route::get('/category-gallery/{url}', [ApiController::class,'categoryGallery']);
Route::get('/news', [ApiController::class,'news']);
Route::get('/notice', [ApiController::class,'notice']);
Route::get('/slider', [ApiController::class,'slider']);

Route::get('/meta-seo/{url?}', [ApiController::class,'metaSeo']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
