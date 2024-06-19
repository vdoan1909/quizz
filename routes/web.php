<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserSubjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix("admin")
    ->as("admin.")
    ->middleware(["auth", "admin_auth"])
    ->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("index");

        Route::prefix("subject")
            ->as("subjects.")
            ->group(function () {
                Route::get("/", [SubjectController::class, "index"])->name("index");
                Route::get("create", [SubjectController::class, "create"])->name("create");
                Route::post("store", [SubjectController::class, "store"])->name("store");
                Route::get("edit/{slug}", [SubjectController::class, "edit"])->name("edit");
                Route::put("update/{slug}", [SubjectController::class, "update"])->name("update");
                Route::delete("destroy/{slug}", [SubjectController::class, "destroy"])->name("destroy");
            });

        Route::prefix("exam")
            ->as("exams.")
            ->group(function () {
                Route::get("/", [ExamController::class, "index"])->name("index");
                Route::get("create", [ExamController::class, "create"])->name("create");
                Route::post("store", [ExamController::class, "store"])->name("store");
                Route::get("edit/{slug}", [ExamController::class, "edit"])->name("edit");
                Route::put("update/{slug}", [ExamController::class, "update"])->name("update");
                Route::delete("destroy/{slug}", [ExamController::class, "destroy"])->name("destroy");
            });

        Route::prefix("question")
            ->as("questions.")
            ->group(function () {
                Route::get("/", [QuestionController::class, "index"])->name("index");
                Route::get("import", [QuestionController::class, "import"])->name("import");
                Route::post("file", [QuestionController::class, "file"])->name("file");
                Route::get("edit/{question}", [QuestionController::class, "edit"])->name("edit");
                Route::put("update/{question}", [QuestionController::class, "update"])->name("update");
                Route::delete("destroy/{question}", [QuestionController::class, "destroy"])->name("destroy");
            });
    });

Route::prefix("/")
    ->as("client.")
    ->group(function () {
        Route::get("/", [HomeController::class, "index"])->name("index");
        Route::get("subject", [HomeController::class, "menu"])->name("menu");

        Route::prefix("subject")
            ->as("subjects.")
            ->group(function () {
                Route::get("detail/{slug}", [UserSubjectController::class, "show"])->name("detail");
                Route::post("store", [UserSubjectController::class, "store"])->name("store");
            });

        Route::prefix("exam")
            ->as("exams.")
            ->group(function () {
                Route::get("/", [HomeController::class, "exams"])->name("index");
                Route::get("examBySubject/{slug}", [HomeController::class, "examBySubject"])->name("examBySubject");
                Route::get("startQuizz/{slug}", [HomeController::class, "startQuizz"])->name("startQuizz");
                Route::post("finally/{slug}", [HomeController::class, "finallyQuizz"])->name("finallyQuizz");
                Route::get("result", [HomeController::class, "result"])->name("result");
            });

        Route::prefix("customer")
        ->as("customers.")
        ->group(function() {
            Route::get("/", [CustomerController::class, "show"])->name("show")->middleware("auth");
        });
    });
