<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UrlGenerateController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/companies/{company?}', 'index')->name('companies.view');
        Route::post('/companies/save/{company?}', 'save')->name('companies.save');
    });

    Route::controller(InvitationController::class)->group(function () {
        Route::any('/invite-user', 'invite')->name('invite.user');
    });

    Route::controller(UrlGenerateController::class)->group(function () {
        Route::get('/urls/{url?}', 'index')->name('urls.index');
        Route::post('/urls/save/{url?}', 'save')->name('urls.save');
        Route::delete('/urls/delete/{url}', 'delete')->name('urls.delete');

        Route::get('redirect/{shortUrl}', [UrlGenerateController::class, 'redirect']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
