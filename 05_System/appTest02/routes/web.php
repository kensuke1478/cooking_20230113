<?php
Route::resource('items','ItemsController');
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\booksController;
const CONTACT_PATH = App\Http\Controllers\ContactsController::class;






// 認証用のルーティングメソッドを実装
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
Route::group(['middleware' => 'auth'], function () {
Route::get('/', [BooksController::class, 'books']);
Route::get('/books', [BooksController::class, 'create']);
Route::post('/books', [BooksController::class, 'store']);
Route::delete('/books/{book}', [BooksController::class, 'destory']);
Route::get('/books/{book}/edit', [BooksController::class, 'edit']);
Route::put('/books/{book}', [BooksController::class, 'update']);
Route::get('/books/{book}/show', [BooksController::class, 'show']);
});

Route::get( '/contact',[CONTACT_PATH, 'show'])->name('contact.show');
Route::post('/contact',[CONTACT_PATH, 'post'])->name('contact.post');
Route::get( '/contact/confirm',[CONTACT_PATH, 'confirm'])->name('contact.confirm');
Route::post('/contact/confirm',[CONTACT_PATH, 'send'])->name('contact.send');
Route::get( '/contact/done',[CONTACT_PATH, 'done'])->name('contact.done');

