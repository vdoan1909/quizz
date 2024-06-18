<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserSubjectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get("/", [HomeController::class, "index"])->name("customer.home");

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

Route::prefix("client")
    ->as("client.")
    ->middleware("auth")
    ->group(function () {
        Route::get("/", [HomeController::class, "index"])->name("index");

        Route::prefix("subject")
            ->as("subjects.")
            ->group(function () {
                Route::get("detail/{slug}", [UserSubjectController::class, "show"])->name("detail");
                Route::post("store", [UserSubjectController::class, "store"])->name("store");
            });
    });
