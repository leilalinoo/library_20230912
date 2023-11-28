<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//admin útvonalak
Route::middleware( ['admin'])->group(function () {
    
});

//basic útvonalak
Route::middleware( ['auth.basic'])->group(function () {
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/reservations', ReservationController::class)->except('put');
    Route::patch('/password_modify/{id}', [UserController::class, 'updatePassword']);
    Route::get('/lendings', [LendingController::class, 'index']);
    Route::get('/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'show']);
    Route::post('/lendings', [LendingController::class, 'store']);
    
    //with fg-ek
    Route::get('/with/user_lendings', [LendingController::class, 'lendingsByUser']);
    Route::get('/with/book_copy_lendings', [CopyController::class, 'bookCopyLending']);
    Route::get('/with/lendings_count_user', [LendingController::class, 'lendingsCountByUser']);
    Route::get('/with/book_copies/{title}', [BookController::class, 'bookCopies']);
    Route::get('/with/user_l_r', [UserController::class, 'userLR']);

    //egyéb lekérdezések
    Route::get('books_at_user', [LendingController::class, 'booksatuser']);
    Route::patch('lengthen/{copy_id}/{start}', [LendingController::class, 'lengthen']);
    //moreLendings($copy_id, $db){
    Route::get('more_lendings/{copy_id}/{db}', [CopyController::class, 'moreLendings']);
});

//bejelentkezés nélkül - nem kell group
Route::get('/with/copies', [BookController::class, 'bookCopy']);
Route::apiResource('/copies', CopyController::class);
Route::apiResource('/books', BookController::class);
//lekérdezések
Route::get('book_publication/{book_id}', [BookController::class, 'bookPublication']);
Route::get('book_publication2/{book_id}', [BookController::class, 'bookPublication2']);
Route::get('book_publication_number/{book_id}', [BookController::class, 'bookPublicationNumber']);
Route::get('book_publication_number2/{book_id}', [BookController::class, 'bookPublicationNumber2']);