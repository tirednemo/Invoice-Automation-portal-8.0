<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UploadFileController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return redirect()->route('invoices.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('invoices', InvoiceController::class)
    ->only(['index', 'create', 'store', 'show', 'update'])
    ->middleware(['auth', 'verified']);
//HTTP method   route URL                   route name/key
// GET          /invoices                   invoices.index
// GET          /invoices/create            invoices.create
// POST         /invoices                   invoices.store
// GET          /invoices/{invoice}         invoices.show
// GET          /invoices/{invoice}/edit    invoices.edit
// PUT/PATCH    /invoices/{invoice}         invoices.update
// DELETE       /invoices/{invoice}         invoices.destroy    


Route::post('/upload-pdf', [UploadFileController::class, 'uploadPDF'])
    ->middleware(['auth'])
    ->name('upload.invoice');

Route::post('/store-data-in-session', [SessionController::class, 'storeDataInSession']);
Route::delete('/delete-data-from-session', [SessionController::class, 'deleteSessionData']);
Route::get('/get-regex-api-url', [SessionController::class, 'getRegexApiUrl']);
Route::get('/get-ocr-api-url', [SessionController::class, 'getOCRApiUrl']);
Route::get('/get-dl-api-url', [SessionController::class, 'getDLApiUrl']);

require __DIR__.'/auth.php';
