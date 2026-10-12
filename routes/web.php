
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    $employees = Employee::latest()->get();

    return view('dashboard', [
        'name' => Auth::user()->name,
        'role' => 'Frontend Developer Intern',
        'totalEmployees' => $employees->count(),
        'activeEmployees' => 0,
        'onLeave' => 0,
        'employees' => $employees,
    ]);
})->middleware('auth')->name('dashboard');

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

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::resource('employees', EmployeeController::class)
    ->middleware('auth');
