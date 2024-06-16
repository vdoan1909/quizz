<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix("admin")
    ->as("admin.")
    // ->middleware(["auth", "admin_auth"])
    ->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("index");

        Route::prefix("subject")
            ->as("subjects.")
            ->group(function () {
                Route::get("/", [SubjectController::class, "index"])->name("index");
                Route::get("create", [SubjectController::class, "create"])->name("create");
                Route::post("store", [SubjectController::class, "store"])->name("store");
                Route::get("edit/{subject}", [SubjectController::class, "edit"])->name("edit");
                Route::put("update/{subject}", [SubjectController::class, "update"])->name("update");
                Route::delete("destroy/{subject}", [SubjectController::class, "destroy"])->name("destroy");
            });

        Route::prefix("exam")
            ->as("exams.")
            ->group(function () {
                Route::get("/", [ExamController::class, "index"])->name("index");
                Route::get("create", [ExamController::class, "create"])->name("create");
                Route::post("store", [ExamController::class, "store"])->name("store");
                Route::get("edit/{exam}", [ExamController::class, "edit"])->name("edit");
                Route::put("update/{exam}", [ExamController::class, "update"])->name("update");
                Route::delete("destroy/{exam}", [ExamController::class, "destroy"])->name("destroy");
            });

        Route::prefix("question")
            ->as("questions.")
            ->group(function () {
                Route::get("/", [QuestionController::class, "index"])->name("index");
                Route::get("import", [QuestionController::class, "import"])->name("import");
                Route::post("file", [QuestionController::class, "file"])->name("file");
                Route::get("edit/{exam}", [QuestionController::class, "edit"])->name("edit");
                Route::put("update/{exam}", [QuestionController::class, "update"])->name("update");
                Route::delete("destroy/{exam}", [QuestionController::class, "destroy"])->name("destroy");
            });
    });

Route::prefix("client")
    ->as("client.")
    // ->middleware("auth")
    ->group(function () {
        Route::get("/", [HomeController::class, "index"])->name("index");
    });
