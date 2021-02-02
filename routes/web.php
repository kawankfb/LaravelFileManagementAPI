<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('files');
});

Route::get('files/{url}',"App\Http\Controllers\FileManagerController@showFolder")
    ->where('url', '.*')->middleware('auth');
Route::get('files',"App\Http\Controllers\FileManagerController@showFolder")->middleware('auth');

Route::post('files/{url}',"App\Http\Controllers\FileManagerController@store")
    ->where('url', '.*')->middleware('auth');
Route::post('files',"App\Http\Controllers\FileManagerController@store")->middleware('auth');

Route::delete('files/{url}',"App\Http\Controllers\FileManagerController@delete")
    ->where('url', '.*')->middleware('auth');
Route::delete('files',"App\Http\Controllers\FileManagerController@delete")->middleware('auth');


Route::get('download/{url}',"App\Http\Controllers\FileManagerController@downloader")
    ->where('url', '.*')->middleware('signed')->name('download');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
