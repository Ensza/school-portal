<?php

use App\Livewire\Admin\Classrooms\Classrooms;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Livewire\Admin\CurriculaAndSubjects\CurriculaAndSubjects;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\TracksAndStrands\TracksAndStrands;

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
    if(Auth::check()){
        if(Auth::user()->role == "administrator"){
            return redirect('admin');
        }
    }
    
    return view('login');
});

Route::post('/', function(){
    return LoginController::login();
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('register', function () {
    return view('register');
});

///////////////////////  Admin  ////////////////////////

Route::middleware('admin')->group(function () {

    Route::get('admin', Dashboard::class)->name('dashboard');
    Route::get('admin/tracks-and-strands', TracksAndStrands::class)->name('tracks-and-strands');
    Route::get('admin/curricula-and-subjects', CurriculaAndSubjects::class)->name('curricula-and-subjects');
    Route::get('admin/classrooms', Classrooms::class)->name('classrooms');

    //--------------------------------------------------------------------------------------------------------

});

/////////////////////////////////////////////////////////


Route::get('test', function(){
    return view('test');
});
