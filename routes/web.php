<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\FormController;

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

/////////////////////// dataTables /////////////////////

Route::get('/tracks', [TrackController::class, 'dataTable'])->name('tracks.data')->middleware('admin');
Route::get('/strands', [StrandController::class, 'dataTable'])->name('strands.data')->middleware('admin');

///////////////////////  Admin  ////////////////////////

Route::middleware('admin')->group(function () {

    Route::get('admin', function(){
        return view('admin.dashboard');
    });

    Route::get('admin/tracks-and-strands', [AdminController::class, 'tracks_and_strands_view']);

    //-----------------Tracks and Strands requests----------------//

        Route::post('admin/tracks/create',[TrackController::class, 'create']);
        Route::get('admin/tracks/edit-row',[TrackController::class, 'editRow']);
        Route::get('admin/tracks/delete', [TrackController::class, 'delete']);

        Route::post('admin/strands/create',[StrandController::class, 'create']);
        Route::get('admin/strands/edit-row',[StrandController::class, 'editRow']);
        Route::get('admin/strands/delete', [StrandController::class, 'delete']);

    //--------------------------------------------------------------------------------------------------------
});


Route::get('test', function(){
    $form = new FormController;
    return $form->make(
        'tracks', 
        '/submit',
        'POST',
        'form',
        [
            'name'=>true
        ],
        [
            'name'
        ]
    );
});


Auth::routes();
