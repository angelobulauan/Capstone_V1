<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCTRL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController\seagrasscontroller;
use App\Http\Controllers\AdminController\SeapicCtrl;
use App\Http\Controllers\UserController\seagrassview;
use App\Http\Controllers\UserController\usermap;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Support\Facades\DB;



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



// Route::get('Addnew',[UserCTRL::class,'index'])-> name('addnew');

// add




Route::get('/dashboard', function () {

    $role = DB::table('role_users')
    ->select('*')
    ->where('user_id',Auth::user()->id)
    ->get();



    if($role[0]->role_id === "1")
    {
       // return Auth::user()->roles[0]->name;
        return view('admin.dashboard');
    }
    else
    {
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

require __DIR__.'/auth.php';
 



//admin
Route::namespace('App\Http\Controllers\AdminController')->prefix('admin')->name('admin.')->group(function(){
    
    Route::resource('seapics','SeapicCtrl');
    Route::get('/myEntries/{id}', 'seagrasscontroller@index')->name('myEntries');

    //new seagrass controller for users only UserController/seagrasscontroller jay folder na
    Route::get('addNew', 'seagrasscontroller@store')->name('addNew');
    Route::get('/edit/{id}', 'seagrasscontroller@edit')->name('edit');

    Route::resource('add','AddNew', ['except'=>['destroy']]);

   
    
  
  

});


//user
Route::namespace('App\Http\Controllers\UserController')->prefix('user')->name('user.')->group(function(){

        
        Route::resource('view','alluserCtrl', ['except'=>['destroy']]);
        Route::get('/seagrass/{id}', 'seagrassview@index')->name('seagrass');
        Route::resource('view','seagrassview');
        Route::resource('maps','usermap');
        Route::get('/map', 'usermap@index')->name('map');
       

       
        

});
 Route::delete('/delete/{d_id}', [seagrasscontroller::class, 'delete'])->name('delete.ko');



       
        


