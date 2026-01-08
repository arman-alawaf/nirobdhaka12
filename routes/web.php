<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

// AJAX search route for modal
Route::post('members/search', [MemberController::class, 'search'])->name('members.search');

// Member Export/Import Routes (must be before resource route)
Route::get('members/export', [MemberController::class, 'export'])->name('members.export');
Route::get('members/import', [MemberController::class, 'showImport'])->name('members.import');
Route::post('members/import', [MemberController::class, 'import'])->name('members.import.store');
Route::delete('members/delete-all', [MemberController::class, 'deleteAll'])->name('members.deleteAll');

// Member CRUD Routes
Route::resource('members', MemberController::class);
