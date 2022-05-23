<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test',[TestController::class,'test']);
Route::get('/notification',[TestController::class,'notification']);

Route::get('/send-message',[NotificationController::class,'sendMessage']);
Route::post('/send-message',[NotificationController::class,'pushMessage']);
Route::get('/push',[NotificationController::class,'sendPush']);




Route::get("/", [HomeController::class,'index']);
Route::get("/posts/{id}",  [PostController::class,'index'])->where("id", "^[0-9]+$");

/**
 * Session routes
 */
Route::get("/login", function() {
    return view("sessions/index");
});

Route::post("/login", [SessionController::class,'doLogin']);
Route::get("/logout", [SessionController::class,'doLogout']);
/**
 * Admin routes
 */
Route::group(["namespace" => "admin", "prefix" => "admin", "middleware" => ["admin"]], function() {

	Route::get("/", [AdminController::class,'index']);
    /**
     * Category routes
     */
    Route::group(["prefix" => "categories"], function() {
        Route::get("/", [CategoryController::class,'index']);
        Route::get("/new", [CategoryController::class,'create']);
        Route::post("/new", [CategoryController::class,'doCreate']);
    });

    /**
     * Post routes
     */
    Route::group(["prefix" => "posts"], function() {
        Route::get("/", [PostController::class,'index']);
        Route::get("/new", [PostController::class,'create']);
        Route::post("/new", [PostController::class,'doCreate']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
