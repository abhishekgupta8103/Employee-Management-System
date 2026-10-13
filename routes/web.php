
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;

// Dashboard
Route::get('/', function () {
    $employees = \App\Models\Employee::latest()->take(3)->get();

    return view('employee', [
        'name' => \Illuminate\Support\Facades\Auth::user()->name,
        'role' => 'Frontend Developer Intern',
        'totalEmployees' => \App\Models\Employee::count(),
        'activeEmployees' => \App\Models\Employee::count(),
        'onLeave' => 0,
        'employees' => $employees,
    ]);
})->middleware('auth')->name('dashboard');

// Login and Register
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Employee CRUD
Route::resource('employees', EmployeeController::class)
    ->middleware('auth');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
