<?php
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MovieController;
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

Auth::routes();

// startseite
Route::get('/', function() {
    return view('start' );
});

Route::get('routes', [RoutesController::class, 'index'])
    ->name('routes')
    ->middleware('auth')
;

Route::group([
    'prefix'    =>  'authors',
], function() {
    Route::get('', [AuthorController::class, 'index'])->name('authors');
    Route::get('{author}', [AuthorController::class, 'show'])->name('authors.show');
});
Route::group([
    'prefix'        => 'authors',
    'middleware'    => 'auth',
], function() {
    Route::get('create', [AuthorController::class, 'create'])->name('authors.create');
    Route::get('edit/{author}', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::get('destroy/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    Route::post('store', [AuthorController::class, 'store'])->name('authors.store');
    Route::post('update/{author}', [AuthorController::class, 'update'])->name('authors.update');
});

Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// wenn eine route aufgerufen wird, die nicht definiert wurde
Route::fallback(function() {
    $message = 'Diese Route gibt\'s nicht bei mir!';
    return view('errors.message', compact('message'));
});
