
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('employee', [
        'name' => 'Abhishek',
        'role' => 'Frontend Developer Intern',
    ]);
});
