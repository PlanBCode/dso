<?php

use App\Http\Controllers\Admin\AssistantsController as AssistantsAdminController;
use App\Http\Controllers\Admin\HomeController as HomeAdminController;
use App\Http\Controllers\Admin\SubjectsController as SubjectsAdminController;
use App\Http\Controllers\Admin\VotingRoundsController as VotingRoundsAdminController;
use App\Http\Controllers\AssistantsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectSuggestionsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/projects', function (Request $request) {
    return Redirect::route('home', ['tab' => $request->get('tab')]);
});

Route::group(['middleware' => ['view.inject.theme', 'view.inject.subjects']], function () {
    Auth::routes();

    Route::group(['name' => 'main'], function () {
        Route::get('/', [MainController::class, 'index'])
            ->name('home');
        Route::get('{context}/trigger', [MainController::class, 'trigger'])
            ->name('trigger');
    });

    Route::group(['prefix' => 'files'], function () {
        Route::post('/create', [FilesController::class, 'store'])
            ->name('files-store');
        Route::delete('/delete/{file}', [FilesController::class, 'destroy'])
            ->name('files-destroy');
    });

    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/{subject}', [SubjectsController::class, 'show'])
            ->name('subject-show');
    });

    Route::group(['prefix' => 'votes'], function () {
        Route::post('/create', [VoteController::class, 'store'])
            ->name('vote-store');
        //Route::get('/confirm-email', [VoteController::class, 'confirmEmail'])
        //    ->name('vote-confirm-email');
    });

    Route::group(['prefix' => 'subject-suggestions'], function () {
        Route::get('/create', [SubjectSuggestionsController::class, 'create'])
            ->name('subject-suggestion-create');

        Route::get('/{subjectSuggestion}/recreate', [SubjectSuggestionsController::class, 'recreate'])
            ->name('subject-suggestion-recreate');

        Route::post('/create', [SubjectSuggestionsController::class, 'store'])
            ->name('subject-suggestion-store');
        Route::get('/{subjectSuggestion}/confirm-email', [SubjectSuggestionsController::class, 'confirmEmail'])
            ->name('subject-suggestion-confirm-email');
    });

    Route::group(['prefix' => 'assistants'], function () {
        Route::post('/create', [AssistantsController::class, 'store'])
            ->name('assistant-store');
        Route::get('/{assistant}/confirm-email', [AssistantsController::class, 'confirmEmail'])
            ->name('assistant-confirm-email');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
        Route::get('/', [HomeAdminController::class, 'show'])
            ->name('admin-home');
        Route::get('/application-update', [HomeAdminController::class, 'updateApplication'])
            ->name('admin-update-application');
        Route::group(['prefix' => 'subjects'], function () {
            Route::get('/', [SubjectsAdminController::class, 'index'])
                ->name('admin-subject-index');
            Route::get('/{subject}', [SubjectsAdminController::class, 'show'])
                ->name('admin-subject-show');
            Route::put('/{subject}', [SubjectsAdminController::class, 'update'])
                ->name('admin-subject-update');
            Route::get('/{subject}/state/{state}', [SubjectsAdminController::class, 'updateState'])
                ->name('admin-subject-update-state');
            Route::get('/{subject}/remove-image', [SubjectsAdminController::class, 'removeImage'])
                ->name('admin-subject-remove-image');
            Route::get('/{subject}/claim', [SubjectsAdminController::class, 'claim'])
                ->name('admin-subject-claim');
            Route::get('/{subject}/claim-release', [SubjectsAdminController::class, 'claimRelease'])
                ->name('admin-subject-claim-release');
            Route::post('/{subject}/accept', [SubjectsAdminController::class, 'accept'])
                ->name('admin-subject-accept');
            Route::post('/{subject}/reject', [SubjectsAdminController::class, 'reject'])
                ->name('admin-subject-reject');
        });
        Route::group(['prefix' => 'assistants'], function () {
            Route::get('/', [AssistantsAdminController::class, 'index'])
                ->name('admin-assistant-index');
            Route::get('/{assistant}', [AssistantsAdminController::class, 'show'])
                ->name('admin-assistant-show');
        });
        Route::group(['prefix' => 'voting-rounds'], function () {
            Route::get('/', [VotingRoundsAdminController::class, 'index'])
                ->name('admin-voting-round-index');
            Route::get('/create', [VotingRoundsAdminController::class, 'create'])
                ->name('admin-voting-round-create');
            Route::post('/store', [VotingRoundsAdminController::class, 'store'])
                ->name('admin-voting-round-store');
            Route::put('/{voting_round}', [VotingRoundsAdminController::class, 'update'])
                ->name('admin-voting-round-update');
            Route::get('/{voting_round}', [VotingRoundsAdminController::class, 'show'])
                ->name('admin-voting-round-show');
            Route::get('/{voting_round}/delete', [VotingRoundsAdminController::class, 'destroy'])
                ->name('admin-voting-round-destroy');
        });
    });
});
