<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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
Route::get('/liste-event', [EventController::class, 'getEvent']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('landingpage'); // Redirige vers la page de landing
})->name('logout');


Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/addEvent',[EventController::class,'addEvent']);
Route::delete('/suppEvent/{id}', [EventController::class, 'deleteEvent']);
Route::get('/update-event/{id}',[EventController::class,'getEventId']);
Route::post('/update-event',[EventController::class,'UpdateEvent']);
Route::get('/add-event', function () {
    return view('add-event');
});

Route::get('/liste-evenementinscrit', [EventController::class, 'listeInscriptions'])->name('events.list');


Route::get('/inscription-event/{id}', [EventController::class, 'inscrire'])->name('event.inscrire');

Route::get('/liste-event',[EventController::class,'getEvent']);
Route::post('/addEvent',[EventController::class,'addEvent']);
Route::get('/gerer-event', [EventController::class,'gererMesEvents'])->name('events.gerer');


