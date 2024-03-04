<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\FeedbackController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('guest')->group(function () {

    Route::get('register', [UserController::class, 'userRegister'])
                ->name('register');
    Route::post('register', [UserController::class, 'userRegisterSubmit']);

    Route::get('login', [UserController::class, 'userLogin'])
                ->name('login');

    Route::post('login', [UserController::class, 'userLoginSubmit']);

    Route::post('logout', [UserController::class, 'logout'])
                ->name('logout');

    
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('feedback', [FeedbackController::class, 'feedBackList'])->name('feed.back');
    Route::get('create', [FeedbackController::class, 'createFeedback'])->name('create.feedback');
    Route::post('submit', [FeedbackController::class, 'submitFeedback'])->name('submit.feedback');

    Route::get('add-comments', [FeedbackController::class, 'feedbackComment'])->name('feedback.comment');
    Route::post('submit-comments', [FeedbackController::class, 'submitFeedbackComment'])->name('submit.comment');


});

require __DIR__.'/auth.php';
