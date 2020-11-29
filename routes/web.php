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
Route::put('/post/star', [App\Http\Controllers\AdminController::class, 'star'])->name('admin.post.star');
Route::put('/post/star/remove', [App\Http\Controllers\AdminController::class, 'remove'])->name('post.star.remove');
Route::post('/push/notif', [App\Http\Controllers\AdminController::class, 'notif'])->name('admin.push.notif');
Route::delete('/push/delete/{notif}', [App\Http\Controllers\AdminController::class, 'deleteNotif'])->name('admin.notif.delete');
Route::get('/support-admin', [App\Http\Controllers\AdminController::class, 'supportAdmin'])->name('supportAdmin');
Route::get('/chatroom/{user}', [App\Http\Controllers\AdminController::class, 'chatRoom'])->name('chatroom');
Route::patch('/chatroom/store/{user}', [App\Http\Controllers\AdminController::class, 'chatRoomStore'])->name('admin.store');

//Covid Case
Route::post('/post/covid/new', [App\Http\Controllers\AdminController::class, 'covidNew'])->name('covid.new');
Route::get('/show/case', [App\Http\Controllers\AdminController::class, 'addNewCaseView'])->name('covid.add.view');
Route::get('/show/update/case', [App\Http\Controllers\AdminController::class, 'updateCaseView'])->name('covid.update.view');
Route::patch('/update/case/recover', [App\Http\Controllers\AdminController::class, 'recover'])->name('covid.update.recover');
Route::patch('/update/case/deceased', [App\Http\Controllers\AdminController::class, 'deceased'])->name('covid.update.deceased');


Route::get('/dashboard-user', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/posts-user', [App\Http\Controllers\UserController::class, 'posts'])->name('user.posts');
Route::get('/user/post/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.post.store');
Route::patch('/user/post/cancel', [App\Http\Controllers\UserController::class, 'cancel'])->name('user.post.cancel');

//Documents form
Route::get('/document-user', [App\Http\Controllers\UserController::class, 'documentShow'])->name('user.document');
Route::get('/support-user', [App\Http\Controllers\UserController::class, 'supportUser'])->name('admin.support');
Route::post('/simple/document/store', [App\Http\Controllers\UserController::class, 'simpleDocument'])->name('simple.document.store');
Route::get('/appointment', [App\Http\Controllers\UserController::class, 'appointmentShow'])->name('user.appointnment');
Route::post('/appointment/store', [App\Http\Controllers\UserController::class, 'appointmentStore'])->name('user.appointnment.store');
Route::patch('/message/store', [App\Http\Controllers\UserController::class, 'messageStore'])->name('user.message.store');

//Reports
Route::post('/user/report', [App\Http\Controllers\UserController::class, 'report'])->name('user.report');
Route::post('/user/report', [App\Http\Controllers\UserController::class, 'report'])->name('user.report');

