<?php
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\LanguageController;
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
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// startseite
Route::get('/', function() {
    return view('start' );
});

Route::get('routes', [RoutesController::class, 'index'])
    ->name('routes')
    ->middleware('auth')
;


Route::group([
    'prefix'    =>  'authors'
], function() {
    Route::get('', [AuthorController::class, 'index'])
        ->name('authors');
    Route::get('{author}', [AuthorController::class, 'show'])
        ->name('authors.show');
        //->where('author', '[0-9]+'); // Make sure the id only contains numbers -> Better in RouteServiceProvider!!!
});

Route::group([
    'prefix'        => 'authors',
    'middleware'    => 'auth'
], function() {
    Route::get('create', [AuthorController::class, 'create'])
        ->name('authors.create');
    Route::get('edit/{author}', [AuthorController::class, 'edit'])
        ->name('authors.edit');
    Route::get('destroy/{author}', [AuthorController::class, 'destroy'])
        ->name('authors.destroy');
    Route::post('store', [AuthorController::class, 'store'])
        ->name('authors.store');
    Route::post('update/{author}', [AuthorController::class, 'update'])
        ->name('authors.update');
});


Route::group([
    'prefix'    =>  'movies'
], function() {
    Route::match(['get', 'post'], '', [MovieController::class, 'index'])->name('movies');
//    Route::get('', [MovieController::class, 'index'])->name('movies');
    Route::get('{movie}', [MovieController::class, 'show'])
        ->name('movies.show');
    //->where('author', '[0-9]+'); // Make sure the id only contains numbers -> Better in RouteServiceProvider!!!
});

//Route::match(['get','post'], '/movies', [MovieController::class, 'index'])->name('movies');
////Route::get('/movies', [MovieController::class, 'index'])->name('movies');
//Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// movie routen für verwaltung
Route::group([
    'prefix'        => 'movies',
    'middleware'    => 'auth'
], function() {
    Route::get('create', [MovieController::class, 'create'])
        ->name('movies.create');
    Route::get('edit/{movie}', [MovieController::class, 'edit'])
        ->name('movies.edit');
    Route::get('destroy/{movie}', [MovieController::class, 'destroy'])
        ->name('movies.destroy');
    Route::post('store', [MovieController::class, 'store'])
        ->name('movies.store');
    Route::post('update/{movie}', [MovieController::class, 'update'])
        ->name('movies.update');
});

// wenn eine route aufgerufen wird, die nicht definiert wurde
Route::fallback(function() {
    $message = 'Diese Route gibt\'s nicht bei mir!';
    return view('errors.message', compact('message'));
});
