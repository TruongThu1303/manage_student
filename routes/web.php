<?php

use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/students', [Student::class, 'index'])->name('students.index');
Route::get('/students/create', [Student::class, 'create'])->name('students.create');
Route::post('/students', [Student::class, 'store'])->name('students.store');
Route::get('/students/{id}', [Student::class, 'show'])->name('students.show');
Route::get('/students/{id}/edit', [Student::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [Student::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [Student::class, 'destroy'])->name('students.destroy');
Route::get('/students/{id}/detail', [Student::class, 'detail'])->name('students.detail');