<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\JobOpeningController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnquiryController as ControllersEnquiryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JobApplicationController as ControllersJobApplicationController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

// Public Routes
Route::group(['middleware' => ['guest'], 'role' => 'admin'], function () {
    Route::get('home', [PagesController::class, 'home'])->name('home');
    Route::get('about', [PagesController::class, 'about'])->name('about');
    Route::get('services', [PagesController::class, 'services'])->name('services');
    Route::get('singleServices/{id}', [PagesController::class, 'singleServices'])->name('singleServices');
    Route::get('hrsolutions', [PagesController::class, 'hrsolutions'])->name('hrsolutions');
    Route::get('prsolutions', [PagesController::class, 'prsolutions'])->name('prsolutions');
    Route::get('jobOpening', [PagesController::class, 'jobOpening'])->name('jobOpening');
    Route::get('gallery', [PagesController::class, 'gallery'])->name('gallery');
    Route::get('contact', [PagesController::class, 'contact'])->name('contact');
    Route::post('contact', [ContactController::class, 'contactStore'])->name('contactStore');
    Route::post('enquiry', [ControllersEnquiryController::class, 'enquiryStore'])->name('enquiryStore');
    Route::post('jobOpening', [ControllersJobApplicationController::class, 'applicationStore'])->name('applicationStore');
});

//Admin Routes
Route::middleware(['auth', 'role.checker:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            // Category
            Route::name('category.')->group(function () {
                Route::get('category', [CategoryController::class, 'index'])->name('index'); // show all category
                Route::get('category/create', [CategoryController::class, 'create'])->name('create'); // show all category
                Route::post('category', [CategoryController::class, 'store'])->name('store'); // store new category
                Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('edit'); // edit existing category
                Route::patch('category/update/{id}', [CategoryController::class, 'update'])->name('update'); // update existing category
                Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy'); // delete existing category
                Route::get('category/deleted/show', [CategoryController::class, 'showDeleted'])->name('deleted'); // show deleted category
                Route::put('category/deleted/restore/{id}', [CategoryController::class, 'restoreDeleted'])->name('restore'); //restore deleted category            

            });

            // Client
            Route::name('client.')->group(function () {
                Route::get('client', [ClientController::class, 'index'])->name('index'); // show all client
                Route::get('client/create', [ClientController::class, 'create'])->name('create'); // show all client
                Route::post('client', [ClientController::class, 'store'])->name('store'); // store new client
                Route::get('client/edit/{id}', [ClientController::class, 'edit'])->name('edit'); // edit existing client
                Route::patch('client/update/{id}', [ClientController::class, 'update'])->name('update'); // update existing client
                Route::delete('client/delete/{id}', [ClientController::class, 'destroy'])->name('destroy'); // delete existing client
                Route::get('client/deleted/show', [ClientController::class, 'showDeleted'])->name('deleted'); // show deleted client
                Route::put('client/deleted/restore/{id}', [ClientController::class, 'restoreDeleted'])->name('restore'); //restore deleted client 
            });

            // Enquiry
            Route::name('enquiry.')->group(function () {
                Route::get('enquiry', [EnquiryController::class, 'index'])->name('index'); // show all Enquiry
                Route::post('enquiry/paginate', [EnquiryController::class, 'pagination'])->name('paginate'); // show all enquiry paginate
                Route::post('enquiry', [EnquiryController::class, 'store'])->name('store'); // store new Enquiry
                Route::get('enquiry/edit/{id}', [EnquiryController::class, 'edit'])->name('edit'); // edit existing Enquiry
                // Route::patch('enquiry/update/{id}', [EnquiryController::class, 'update'])->name('update'); // update existing Enquiry
                Route::delete('enquiry/delete/{id}', [EnquiryController::class, 'destroy'])->name('destroy'); // delete existing Enquiry
                Route::get('enquiry/deleted/show', [EnquiryController::class, 'showDeleted'])->name('deleted'); // show deleted Enquiry
                Route::put('enquiry/deleted/restore/{id}', [EnquiryController::class, 'restoreDeleted'])->name('restore'); //restore deleted Enquiry    
            });

            // Job Application
            Route::name('application.')->group(function () {
                Route::get('application', [JobApplicationController::class, 'index'])->name('index'); // show all application
                Route::get('application/create', [JobApplicationController::class, 'create'])->name('create'); // show all application
                Route::post('application', [JobApplicationController::class, 'store'])->name('store'); // store new application
                Route::get('application/edit/{id}', [JobApplicationController::class, 'edit'])->name('edit'); // edit existing application
                Route::patch('application/update/{id}', [JobApplicationController::class, 'update'])->name('update'); // update existing application
                Route::delete('application/delete/{id}', [JobApplicationController::class, 'destroy'])->name('destroy'); // delete existing application
                Route::get('application/deleted/show', [JobApplicationController::class, 'showDeleted'])->name('deleted'); // show deleted application
                Route::put('application/deleted/restore/{id}', [JobApplicationController::class, 'restoreDeleted'])->name('restore'); //restore deleted application 
            });

            // Job Opening
            Route::name('jobOpening.')->group(function () {
                Route::get('jobOpening', [JobOpeningController::class, 'index'])->name('index'); // show all jobOpening
                Route::get('jobOpening/create', [JobOpeningController::class, 'create'])->name('create'); // show all jobOpening
                Route::post('jobOpening', [JobOpeningController::class, 'store'])->name('store'); // store new jobOpening
                Route::get('jobOpening/edit/{id}', [JobOpeningController::class, 'edit'])->name('edit'); // edit existing jobOpening
                Route::patch('jobOpening/update/{id}', [JobOpeningController::class, 'update'])->name('update'); // update existing jobOpening
                Route::delete('jobOpening/delete/{id}', [JobOpeningController::class, 'destroy'])->name('destroy'); // delete existing jobOpening
                Route::get('jobOpening/deleted/show', [JobOpeningController::class, 'showDeleted'])->name('deleted'); // show deleted jobOpening
                Route::put('jobOpening/deleted/restore/{id}', [JobOpeningController::class, 'restoreDeleted'])->name('restore'); //restore deleted jobOpening 
            });

            // Services
            Route::name('services.')->group(function () {
                Route::get('services', [ServicesController::class, 'index'])->name('index'); // show all services
                Route::get('services/create', [ServicesController::class, 'create'])->name('create'); // show all services
                Route::post('services', [ServicesController::class, 'store'])->name('store'); // store new services
                Route::get('services/edit/{id}', [ServicesController::class, 'edit'])->name('edit'); // edit existing services
                Route::patch('services/update/{id}', [ServicesController::class, 'update'])->name('update'); // update existing services
                Route::delete('services/delete/{id}', [ServicesController::class, 'destroy'])->name('destroy'); // delete existing services
                Route::get('services/deleted/show', [ServicesController::class, 'showDeleted'])->name('deleted'); // show deleted services
                Route::put('services/deleted/restore/{id}', [ServicesController::class, 'restoreDeleted'])->name('restore'); //restore deleted services 
            });

            // Slider
            Route::name('slider.')->group(function () {
                Route::get('slider', [SliderController::class, 'index'])->name('index'); // show all slider
                Route::get('slider/create', [SliderController::class, 'create'])->name('create'); // show all slider
                Route::post('slider', [SliderController::class, 'store'])->name('store'); // store new slider
                Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('edit'); // edit existing slider
                Route::patch('slider/update/{id}', [SliderController::class, 'update'])->name('update'); // update existing slider
                Route::delete('slider/delete/{id}', [SliderController::class, 'destroy'])->name('destroy'); // delete existing slider
                Route::get('slider/deleted/show', [SliderController::class, 'showDeleted'])->name('deleted'); // show deleted slider
                Route::put('slider/deleted/restore/{id}', [SliderController::class, 'restoreDeleted'])->name('restore'); //restore deleted slider 
            });

            // Testimonials
            Route::name('testimonials.')->group(function () {
                Route::get('testimonials', [TestimonialsController::class, 'index'])->name('index'); // show all testimonials
                Route::get('testimonials/create', [TestimonialsController::class, 'create'])->name('create'); // show all testimonials
                Route::post('testimonials', [TestimonialsController::class, 'store'])->name('store'); // store new Testimonials
                Route::get('testimonials/edit/{id}', [TestimonialsController::class, 'edit'])->name('edit'); // edit existing Testimonials
                Route::patch('testimonials/update/{id}', [TestimonialsController::class, 'update'])->name('update'); // update existing Testimonials
                Route::delete('testimonials/delete/{id}', [TestimonialsController::class, 'destroy'])->name('destroy'); // delete existing Testimonials
                Route::get('testimonials/deleted/show', [TestimonialsController::class, 'showDeleted'])->name('deleted'); // show deleted Testimonials
                Route::put('testimonials/deleted/restore/{id}', [TestimonialsController::class, 'restoreDeleted'])->name('restore'); //restore deleted Testimonials 
            });

            // Album
            Route::name('album.')->group(function () {
                Route::get('album', [AlbumController::class, 'index'])->name('index'); // show all album
                Route::get('album/create', [AlbumController::class, 'create'])->name('create'); // show all album
                Route::post('album', [AlbumController::class, 'store'])->name('store'); // store new album
                Route::get('album/edit/{id}', [AlbumController::class, 'edit'])->name('edit'); // edit existing album
                Route::patch('album/update/{id}', [AlbumController::class, 'update'])->name('update'); // update existing album
                Route::delete('album/delete/{id}', [AlbumController::class, 'destroy'])->name('destroy'); // delete existing album
                Route::get('album/deleted/show', [AlbumController::class, 'showDeleted'])->name('deleted'); // show deleted album
                Route::put('album/deleted/restore/{id}', [AlbumController::class, 'restoreDeleted'])->name('restore'); //restore deleted album            

            });

            // Gallery
            Route::name('gallery.')->group(function () {
                Route::get('gallery', [GalleryController::class, 'index'])->name('index'); // show all gallery
                Route::get('gallery/create', [GalleryController::class, 'create'])->name('create'); // show all gallery
                Route::post('gallery/upload', [GalleryController::class, 'imageUpload'])->name('upload'); // store new gallery
                Route::post('gallery', [GalleryController::class, 'store'])->name('store'); // store new gallery
                // Route::get('testimonials/edit/{id}', [TestimonialsController::class, 'edit'])->name('edit'); // edit existing Testimonials
                // Route::patch('testimonials/update/{id}', [TestimonialsController::class, 'update'])->name('update'); // update existing Testimonials
                Route::delete('gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('destroy'); // delete existing Testimonials
                Route::get('gallery/deleted/show', [GalleryController::class, 'showDeleted'])->name('deleted'); // show deleted Testimonials
                Route::put('gallery/deleted/restore/{id}', [GalleryController::class, 'restoreDeleted'])->name('restore'); //restore deleted Testimonials 
            });
        });
    });
});



//Admin Routes
/*
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role.checker'], 'role' => 'admin', 'namespace' => 'Admin'], function () {
    // category
    Route::get('category', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']); // show all category
    Route::get('category/create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']); //  add new category
    Route::post('category', ['as' => 'admin.category.store', 'uses' => 'CategoryController@store']); // store new category
    Route::get('category/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']); // edit existing category
    Route::patch('category/update/{id}', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']); // update existing category
    Route::delete('category/delete/{id}', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@destroy']); // delete existing category
    Route::get('category/deleted/show', ['as' => 'admin.category.deleted.show', 'uses' => 'CategoryController@showDeleted']); // show deleted category
    Route::put('category/deleted/restore/{id}', ['as' => 'admin.category.deleted.restore', 'uses' => 'CategoryController@restoreDeleted']); //restore deleted category

});
*/


//Auth Routes
Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('index');
});
