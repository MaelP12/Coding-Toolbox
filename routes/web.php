<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('teachers', [TeacherController::class, 'store'])->name('teacher.store');
        Route::post('teachers/update/{student}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::get('teachers/form/{student}', [TeacherController::class, 'getForm'])->name('teacher.form');
        Route::delete('teachers/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');


        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');
        Route::post('students', [StudentController::class, 'store'])->name('student.store');
        Route::post('students/update/{student}', [StudentController::class, 'update'])->name('student.update');
        Route::get('students/form/{student}', [StudentController::class, 'getForm'])->name('student.form');
        Route::delete('students/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');

        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');

        // Retro
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');

        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
    });

});

require __DIR__.'/auth.php';
