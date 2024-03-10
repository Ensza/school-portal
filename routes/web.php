<?php

use App\FormMaker\FormMaker;
use App\FormMaker\Input;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CurriculumControler;
use App\Livewire\Admin\Classrooms\Classrooms;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubjectController;
use App\Livewire\Admin\CreateTrack;
use App\Livewire\Admin\CurriculaAndSubjects\CurriculaAndSubjects;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\TracksAndStrands\TracksAndStrands;
use GuzzleHttp\Psr7\Request;

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

Auth::routes();
