<?php

use App\Http\Controllers\Admin\SubjectsController as SubjectsAdminController;
use App\Http\Controllers\Admin\SubjectSuggestionsController as SubjectSuggestionsAdminController;
use App\Http\Controllers\AssistantsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\SubjectSuggestionsController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['view.inject.theme', 'view.inject.subjects']], function () {
    Auth::routes();

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::group(['prefix' => 'files'], function () {
        Route::post('/create', [FilesController::class, 'store'])
            ->name('files-store');
        Route::delete('/delete/{file}', [FilesController::class, 'destroy'])
            ->name('files-destroy');
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('', [ProjectsController::class, 'index'])
            ->name('projects');
    });

    Route::group(['prefix' => 'subjects'], function () {
        Route::get('/{subject}', [SubjectsController::class, 'show'])
            ->name('subject-show');
    });

    Route::group(['prefix' => 'subject-suggestions'], function () {
        Route::get('/create', [SubjectSuggestionsController::class, 'create'])
            ->name('subject-suggestion-create');
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
        Route::group(['prefix' => 'subject-suggestions'], function () {
            Route::post('/{subjectSuggestion}/accept', [SubjectSuggestionsAdminController::class, 'accept'])
                ->name('admin-subject-suggestion-accept');
            Route::post('/{subjectSuggestion}/reject', [SubjectSuggestionsAdminController::class, 'reject'])
                ->name('admin-subject-suggestion-reject');
        });
        Route::group(['prefix' => 'subjects'], function () {
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
        });
    });
});
