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



    if ($role[0]->role_id === "1") {
        $totaluser = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();
        // return Auth::user()->roles[0]->name;
        return view('admin.dashboard')->with('totaluser', $totaluser);
    } else {

        // return Auth::user()->roles[0]->name;
        return view('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');





// Route::get('/user.seagrassss', [seagrasscontroller::class, 'show'])->name('user.seagrassss');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
        });









