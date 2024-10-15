<?php

use App\Http\Controllers\AdminController\alluserctrl;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCTRL;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController\seagrasscontroller;
use App\Http\Controllers\AdminController\SeapicCtrl;
use App\Http\Controllers\UserController\seagrassview;
use App\Http\Controllers\UserController\usermap;
use App\Http\Controllers\UserController\contactCtrl;
use App\Http\Controllers\UserController\articleCtrl;
use App\Http\Controllers\ContactController;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map', function () {
    return view('user.map');
});

Route::get('/contact', function () {
    return view('user.contact');
});
Route::get('/article', function () {
    return view('user.article');
});





// Route::get('Addnew',[UserCTRL::class,'index'])-> name('addnew');

// add




Route::get('/dashboard', function () {

    $role = DB::table('role_users')
        ->select('*')
        ->where('user_id', Auth::user()->id)
        ->get();

    if ($role[0]->role_id === "2") {
        $totaluser = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();
        return view('admin.dashboard')->with('totaluser', $totaluser);
    } else if ($role[0]->role_id === "1") {
        return view('superadmin.dashboard');
    } else {
        return view('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');





// Route::get('/user.seagrassss', [seagrasscontroller::class, 'show'])->name('user.seagrassss');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile-ID', [ProfileController::class, 'IDupdate'])->name('profile.IDupdate');

});

require __DIR__ . '/auth.php';




//admin
Route::
        namespace('App\Http\Controllers\AdminController')->prefix('admin')->name('admin.')->group(function () {

            Route::resource('seapics', 'SeapicCtrl');
            Route::get('/myEntries', 'seagrasscontroller@index')->name('myEntries');

            //new seagrass controller for users only UserController/seagrasscontroller jay folder na
            Route::post('addNew', 'seagrasscontroller@store')->name('addNew');

            //route in editing seagrass entries
            Route::post('/editseagrass/{id}', 'seagrasscontroller@edit')->name('editseagrass');

            //route in seleting a record in seagrass entries
            Route::get('/deleteseagrass/{id}', 'seagrasscontroller@destroy')->name('deleteseagrass');

            Route::resource('add', 'AddNew', ['except' => ['destroy']]);

            // route sa pag select ng kung anong image ang idisplay
            Route::post('/update-photo/{id}/{photo}', 'seagrasscontroller@updatePhoto')->name('update-photo');

            Route::get('/pendingapproval', 'seagrasscontroller@pendingapproval')->name('admin.pendingapproval');

            Route::put('/approve/{id}', 'seagrasscontroller@approve')->name('admin.approve');
            Route::put('/reject/{id}', 'seagrasscontroller@reject')->name('admin.reject');

            Route::resource('/view', 'alluserctrl');
            Route::get('/view', 'alluserctrl@index')->name('view');





        });


//user
Route::
        namespace('App\Http\Controllers\UserController')->prefix('user')->name('user.')->group(function () {



            Route::get('/seagrass/{id}', 'seagrassview@index')->name('seagrass');
            Route::resource('view', 'seagrassview');
            Route::resource('maps', 'usermap');
            Route::get('/map', 'usermap@index')->name('map');
            Route::resource('contact', 'contactCtrl');
            Route::get('/contact', 'contactCtrl@index')->name('contact');
            Route::resource('article', 'articleCtrl');
            Route::get('/article', 'articleCtrl@index')->name('article');
            Route::get('like/{id}', 'seagrassview@like')->name('like');
            Route::get('dislike/{id}', 'seagrassview@dislike')->name('dislike');
            Route::get('updateView/{id}', 'seagrassview@view')->name('updateView');
            Route::get('/addnew', 'seagrassview@addnew')->name('addnew');
            Route::post('/addnew', 'seagrassview@store')->name('addnew.store');
            Route::get('/search', 'seagrassview@search')->name('seagrass.search');
        });

//request
Route::
        namespace('App\Http\Controllers\UserController')->prefix('request')->name('request.')->group(function () {
            Route::get('/', 'requestCtrl@index')->name('requests.index');
            Route::resource('/request', 'requestCtrl');
            // Route::get('/show/{id}', 'requestCtrl@show')->name('requests.show');
            Route::post('/request/{id}/archive', 'requestCtrl@archiveMessage')->name('requests.archive');

        });


        Route::
        namespace('App\Http\Controllers\SuperadminController')->prefix('superadmin')->name('superadmin.')->group(function () {

            Route::get('/verify', 'UserVerifyCtrl@index')->name('verify');
            Route::put('/verify/{id}/reject', 'UserVerifyCtrl@reject')->name('reject');
            Route::put('/verify/{id}/verified', 'UserVerifyCtrl@verified')->name('verified');

        });

