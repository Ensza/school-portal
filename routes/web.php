<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\StrandController;
use App\Models\Track;
use App\Models\Strand;

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

Route::get('admin', function(){
    return view('admin.dashboard');
})->middleware('admin');

Route::get('admin/tracks-and-strands',function(){
    return view('admin.tracks-and-strands',[
        'tracks'=>Track::all(), 
        'strands'=>Strand::all(),
        'tracks_table'=>TrackController::dataTable(),
        'strands_table'=>StrandController::dataTable()
    ]); 
})->middleware('admin');

Route::post('admin/add-track',function(){
    $validator = validator(request()->all(), //validate add track form request
        [
            'name'=>'required',
            'code'=>'required|unique:tracks'
        ],[
            'name'=>'track name is required',
            'code.required'=>'track code is required',
            'code.unique'=>'track code must be unique'
        ]);
    $validation_result = ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
    if(!$validator->fails()){
        $validation_result['new_track'] = TrackController::create(request()->all());
        if(!$validation_result['new_track']){ //if adding to database failed
            return ['is_invalid'=>true, 'errors'=>['error'=>'something went wrong']];
        }else{
        }
    }
    return $validation_result;
});

Route::post('admin/add-strand',function(){
    $validator = validator(request()->all(), //validate add stran form request
        [
            'name'=>'required',
            'code'=>'required|unique:strands',
            'track_id'=>'required|exists:tracks,id'
        ],[
            'name'=>'strand name is required',
            'code.required'=>'strand code is required',
            'code.unique'=>'strand code must be unique',
            'track_id.required'=>'please select a track',
            'track_id.exists'=>'track doesn\'t exist'
        ]);
    $validation_result = ['is_invalid'=>$validator->fails(), 'errors'=>$validator->errors()];
    if(!$validator->fails()){
        if(!StrandController::create(request()->all())){ //if adding to database failed
            return ['is_invalid'=>true, 'errors'=>['error'=>'something went wrong']];
        }
    }
    return $validation_result;
});

// Route::get('test', function(){
//     return TrackController::dataTable();
// });


Auth::routes();
