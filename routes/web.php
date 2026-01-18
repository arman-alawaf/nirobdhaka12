<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PdfSearchController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/center-search', function () { return view('center-search'); });
Route::get('/api/pdfs', [PdfSearchController::class, 'getPdfList'])->name('pdfs.list');
Route::post('/api/pdfs/search', [PdfSearchController::class, 'searchNid'])->name('pdfs.search');

// AJAX search route for modal
Route::post('members/search', [MemberController::class, 'search'])->name('members.search');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Protected routes - Members Management (requires authentication)
Route::middleware(['auth'])->group(function () {

    // Member Export/Import Routes (must be before resource route)
    Route::get('members/export', [MemberController::class, 'export'])->name('members.export');
    Route::get('members/import', [MemberController::class, 'showImport'])->name('members.import');
    Route::post('members/import', [MemberController::class, 'import'])->name('members.import.store');
    Route::delete('members/delete-all', [MemberController::class, 'deleteAll'])->name('members.deleteAll');

    // Member CRUD Routes
    Route::resource('members', MemberController::class);
});
