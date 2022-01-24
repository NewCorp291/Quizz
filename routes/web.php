<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserIsAdmin;
use App\Http\Middleware\UserIsLoggedIn;
use Illuminate\Support\Facades\Route;

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

// /api
Route::group([
    'prefix' => 'api'
], function ($router) {

    // /quiz
    Route::group([
        "prefix" => "quiz"
    ], function ($router) {
        Route::get("/", [QuizController::class, "index"]);
        Route::post("/", [QuizController::class, "create"])->middleware(UserIsAdmin::class);
        Route::put("/{quiz}", [QuizController::class, "edit"])->middleware(UserIsAdmin::class);
        Route::get("{quiz}", [QuizController::class, "show"]);
        Route::delete("{quiz}", [QuizController::class, "destroy"]);
        Route::post("{quiz}/publish", [QuizController::class, "publish"])->middleware(UserIsAdmin::class);
        Route::post("{quiz}/unpublish", [QuizController::class, "unpublish"])->middleware(UserIsAdmin::class);
        Route::get("{quiz}/questions", [QuizController::class, "questions"]);
    });

    Route::get("/question/{id}/choices", [QuestionController::class, "choices"]);

	// /api/score
	Route::group([
		"prefix" => "score",
	], function ($router) {
		Route::get("/", [ScoreController::class, 'index']);
		Route::get("/{id}", [ScoreController::class, 'show'])->middleware(UserIsLoggedIn::class);
		Route::post("/", [ScoreController::class, 'addScore'])->middleware(UserIsLoggedIn::class);
	});

	// /api/user
	Route::group([
		"prefix" => "user"
	], function ($router) {
		Route::get("/{id}", [UserController::class, 'show']);
	});

	// /api/auth
	Route::group([
		'middleware' => 'api',
		'prefix' => 'auth'
	], function ($router) {
		Route::post('/login', [AuthController::class, 'login']);
		Route::post('/register', [AuthController::class, 'register']);
		Route::post('/logout', [AuthController::class, 'logout']);
		Route::post('/refresh', [AuthController::class, 'refresh']);
		Route::get('/user-profile', [AuthController::class, 'userProfile']);
	});
});

Route::get("{catchall}", function () {
    return view("welcome");
})->where("catchall", ".*");
