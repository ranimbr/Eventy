<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/add-event', function () {
    return view('add-event');
});
Route::get('/liste-event', function () {
    return view('liste-event');
});

Route::get('/add-user', function () {
    return view('add-user');
});

Route::get('/update-user', function () {
    return view('update-user');
});
Route::post('/addUser',[UtilisateurController::class,'addUser']);
Route::get('/liste-user',[UtilisateurController::class,'getUser']);
Route::delete('/suppUser/{id}',[UtilisateurController::class,'deleteUser']);

Route::get('/update-user/{id}', [UtilisateurController::class, 'getUserId']);
Route::post('/update-user', [UtilisateurController::class, 'updateUser']);

Route::get('/liste-event',[EventController::class,'getEvent']);
Route::post('/addEvent',[EventController::class,'addEvent']);
Route::delete('/suppEvent/{id}', [EventController::class, 'deleteEvent']);
Route::get('/update-event/{id}',[EventController::class,'getEventId']);
Route::post('/update-event',[EventController::class,'UpdateEvent']);
Route::get('/calendar', function () {
    return view('calendar');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('landingpage'); // Redirige vers la page de landing
})->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/toggle-user-block/{id}', [UtilisateurController::class, 'toggleBlock']);


