<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MetatagSeoController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;



Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::match(['get', 'post'],'/add-branch/{id?}', [App\Http\Controllers\BranchController::class, 'create']);
    Route::get('/all-branch', [App\Http\Controllers\BranchController::class, 'index']);
    Route::get('/delete-branch/{id?}', [App\Http\Controllers\BranchController::class, 'destroy']);

    Route::match(['get', 'post'],'/add-about-branch/{id?}', [App\Http\Controllers\BranchAboutController::class, 'index']);
    Route::get('/update-about-branch/{id?}', [App\Http\Controllers\BranchAboutController::class, 'update']);
    Route::get('/delete-about-branch/{id?}', [App\Http\Controllers\BranchAboutController::class, 'destroy']);

    Route::match(['get', 'post'],'/add-branch-facilities/{id?}', [App\Http\Controllers\BranchFacilitiesController::class, 'index']);
    Route::post('/update-branch-facilities/{id?}', [App\Http\Controllers\BranchFacilitiesController::class, 'update']);
    Route::get('/delete-branch-facilities/{id?}', [App\Http\Controllers\BranchFacilitiesController::class, 'destroy']);

    Route::match(['get', 'post'],'/add-about/{id?}', [AboutController::class, 'create']);
    Route::get('/create-about', [AboutController::class, 'createAbout']);
    Route::get('/all-about', [AboutController::class, 'index']);
    Route::get('/delete-about/{id?}', [AboutController::class, 'destroy']);



    Route::match(['get', 'post'],'/add-gallery/{id?}', [GalleryController::class, 'create']);
    Route::get('/delete-gallery/{id?}', [GalleryController::class, 'destroy']);



    Route::match(['get', 'post'],'/add-news/{id?}', [App\Http\Controllers\NewsController::class, 'index']);
    Route::get('/delete-news/{id?}', [App\Http\Controllers\NewsController::class, 'destroy']);

    Route::match(['get', 'post'],'/add-tc-certificate/{id?}', [App\Http\Controllers\CertificateController::class, 'index']);
    Route::get('/delete-certificate/{id?}', [App\Http\Controllers\CertificateController::class, 'destroy']);


    Route::match(['get', 'post'],'/add-result/{id?}', [App\Http\Controllers\ResultController::class, 'index']);
    Route::get('/delete-result/{id?}', [App\Http\Controllers\ResultController::class, 'destroy']);


    Route::match(['get', 'post'],'/add-notice/{id?}', [App\Http\Controllers\NoticeController::class, 'index']);
    Route::get('/delete-notice/{id?}', [App\Http\Controllers\NoticeController::class, 'destroy']);

    Route::match(['get', 'post'],'/add-gallery-category/{id?}', [App\Http\Controllers\GalleryCategoryController::class, 'create']);
    Route::get('/delete-gallery-category/{id?}', [App\Http\Controllers\GalleryCategoryController::class, 'destroy']);

    Route::match(['get', 'post'],'/add-gallery-category-image/{branch?}/{category?}', [App\Http\Controllers\GalleryImagesController::class, 'create']);
    Route::get('/delete-category-image/{id?}', [App\Http\Controllers\GalleryImagesController::class, 'destroy']);

    Route::match(['get', 'post'],'/slider', [App\Http\Controllers\SliderController::class, 'AddSlider']);
    Route::get('/delete-slider/{id}', [App\Http\Controllers\SliderController::class, 'DeleteSlider']);

    Route::get('/contact-list', [App\Http\Controllers\ContactController::class, 'index']);
    Route::get('/update-contact/{id?}', [App\Http\Controllers\ContactController::class, 'update']);
    Route::get('/career-list', [App\Http\Controllers\CareerController::class, 'index']);
    Route::get('/update-career/{id?}', [App\Http\Controllers\CareerController::class, 'update']);

    Route::match(['get', 'post'],'/add-meta-tag/{id?}', [App\Http\Controllers\MetatagSeoController::class, 'index']);
    Route::get('/update-meta-tag/{id?}', [App\Http\Controllers\MetatagSeoController::class, 'update']);
    Route::get('/delete-meta-tag/{id?}', [App\Http\Controllers\MetatagSeoController::class, 'destroy']);

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');



    Route::patch('/user/profile', function (Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('status', 'profile-updated');

    })->middleware('auth')->name('profile.update');



    Route::put('/user/password', function (Request $request) {

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password incorrect']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'password-updated');

    })->middleware('auth')->name('password.update');

});
