<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashoardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('', [DashoardController::class, 'index'])->name('dashboard');

// Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function(){

//     // Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

//     Route::group(['middleware' => 'auth'], function(){

//         // Route::post('/', [IdeaController::class, 'store'])->name('create');

//         // Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

//         // Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');

//         // Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');

//         // Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
//     });
// });

Route::resource('ideas', IdeaController::class)->except(['show'])->middleware('auth');

Route::resource('ideas', IdeaController::class)->only(['show']);

Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show', 'edit', 'update'])->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('/terms', function(){
    return view('terms');
})->name('terms');
Route::get('/feed', [FeedController::class, 'index']);