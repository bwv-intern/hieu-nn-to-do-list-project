<?php

use App\Http\Controllers\{
    AuthController,
    CategoryController,
    TaskController,
};
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

// GUEST group: Only for users who are not logged in.
Route::middleware(['guest'])->group(function () {
    
    // Sign Up Page
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Login Page
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// AUTH group: Only for users who are logged in.
Route::middleware(['auth'])->group(function () {

    // Dashboard page (You will implement CRUD for tasks here later)
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    /**
     * Category:
     * This resource route will automatically generate routes such as:
     * index (GET), store (POST), destroy (DELETE), etc.
     */ 
    Route::resource('categories', CategoryController::class);

    /**
     * Task:
     */
    Route::resource('tasks', TaskController::class);
    // Dedicated route for quick state changes
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');

    // Logout (Use POST for better security)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});