<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RegionController as AdminRegionController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JoinApplicationController;
use App\Http\Middleware\EnsureAdminAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('/regions', [App\Http\Controllers\RegionController::class, 'index'])->name('regions.index');
Route::get('/regions/{slug}', [App\Http\Controllers\RegionController::class, 'show'])->name('regions.show');
Route::get('/news/{slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/activities', [App\Http\Controllers\PageController::class, 'activities'])->name('activities');
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members.index');
Route::get('/members/secretary', [App\Http\Controllers\MemberController::class, 'secretary'])->name('members.secretary');
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/partners', [App\Http\Controllers\PageController::class, 'partners'])->name('partners');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::get('/join', [App\Http\Controllers\PageController::class, 'join'])->name('join');
Route::post('/join/apply', [JoinApplicationController::class, 'store'])->name('join.apply');

Route::get('/admin/login', [LoginController::class, 'show'])->name('admin.login');
Route::post('/admin/login/authenticate', [LoginController::class, 'authenticate'])->middleware('throttle:5,1')->name('admin.login.authenticate');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware([EnsureAdminAuthenticated::class])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/join-applications', [JoinApplicationController::class, 'index'])->name('admin.join.index');
    Route::get('/admin/join-applications/{joinApplication}', [JoinApplicationController::class, 'show'])->name('admin.join.show');
    Route::patch('/admin/join-applications/{joinApplication}/status', [JoinApplicationController::class, 'updateStatus'])->name('admin.join.update');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('regions', AdminRegionController::class)->except('show');
        Route::resource('members', AdminMemberController::class)->except('show');
        Route::resource('news', NewsController::class)->except('show')->parameters(['news' => 'news']);
        Route::resource('events', EventController::class)->except('show');
        Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
    });
});
