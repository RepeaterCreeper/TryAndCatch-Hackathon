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

Route::get('/', function() {
    return redirect()->route('site.statistics');
});

Route::get('/announcement-admin', function() {
    return view('announcement-admin');
});

Auth::routes();

Route::get('/site', [App\Http\Controllers\SiteController::class, 'control'])->name('site.control');
Route::get('/announcement', [App\Http\Controllers\SiteController::class, 'announcement'])->name('site.announcement');
Route::get('/statistics', [App\Http\Controllers\SiteController::class, 'statistics'])->name('site.statistics');

Route::get('/dashboard-admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/dashboard-approval', [App\Http\Controllers\AdminController::class, 'approval'])->name('admin.approval');
Route::get('/announcement-admin', [App\Http\Controllers\AdminController::class, 'announcement'])->name('admin.announcement');
Route::get('/statistics-admin', [App\Http\Controllers\AdminController::class, 'statistics'])->name('admin.statistics');
Route::get('/request/{email}', [App\Http\Controllers\AdminController::class, 'image'])->name('admin.view.image');
Route::patch('/request/{user}', [App\Http\Controllers\AdminController::class, 'add'])->name('admin.add');
Route::delete('/request/{user}', [App\Http\Controllers\AdminController::class, 'reject'])->name('admin.reject');
Route::post('/post/admin/store', [App\Http\Controllers\AdminController::class, 'post'])->name('admin.post.store');
Route::patch('/post/admin/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.post.update');
Route::delete('/post/admin/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.post.delete');
Route::patch('/post/user/deny', [App\Http\Controllers\AdminController::class, 'deny'])->name('admin.post.deny');
Route::patch('/post/user/approve', [App\Http\Controllers\AdminController::class, 'approve'])->name('admin.post.approve');

Route::get('/dashboard-user', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/posts-user', [App\Http\Controllers\UserController::class, 'posts'])->name('user.posts');
Route::get('/user/post/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.post.store');
Route::patch('/user/post/cancel', [App\Http\Controllers\UserController::class, 'cancel'])->name('user.post.cancel');

Route::get('/appointment-user', function() {
    return view('appointment-user');
});

Route::get('/document-user', function() {
    return view('document-user');
});

Route::get('/support-user', function() {
    return view('support-user');
});
