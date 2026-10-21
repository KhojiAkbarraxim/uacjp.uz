<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\JoinApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
Route::get('/regions/{slug}', [RegionController::class, 'show'])->name('regions.show');
Route::get('/activities', [PageController::class, 'activities'])->name('activities');
Route::get('/members', [MemberController::class, 'index'])->name('members.index');
Route::get('/members/secretary', [MemberController::class, 'secretary'])->name('members.secretary');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/partners', [PageController::class, 'partners'])->name('partners');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/join', [PageController::class, 'join'])->name('join');
Route::post('/join/apply', [JoinApplicationController::class, 'store'])->name('join.apply');
Route::get('/admin/join-applications', [JoinApplicationController::class, 'index'])->name('admin.join.index');
