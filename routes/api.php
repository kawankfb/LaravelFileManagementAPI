<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/register',function(Request $request){
    $input=['name'=>$request->name,
    'email'=>$request->email,
    'password'=>$request->password
];
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'max:255']
    ])->validate();

     return User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ]);
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    auth()->loginUsingId($user->id);
    return $user->createToken($request->device_name)->plainTextToken;
})->name("token_generator");

Route::apiResource('files','App\Http\Controllers\FileController')->middleware('auth:sanctum');
Route::get('files/{url}',"App\Http\Controllers\FileController@getByFolder")->where('url', '.*')->middleware('auth:sanctum');
Route::delete('files/{url}',"App\Http\Controllers\FileController@destroy")->where('url', '.*')->middleware('auth:sanctum');