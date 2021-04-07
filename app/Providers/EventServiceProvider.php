<?php

namespace App\Providers;

use App\Events\Assistant;
use App\Events\SubjectSuggestion;
use App\Events\Subject;
use App\Listeners\AutoPopulateSubject;
use App\Listeners\SendMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SubjectSuggestion\Created::class => [
            SendMail\SubjectSuggestionCreatedListener::class,
        ],
        SubjectSuggestion\Updated::class => [
            AutoPopulateSubject\SubjectSuggestionUpdatedListener::class
        ],
        Subject\CreatedWithSuggestion::class => [
            SendMail\SubjectWithSuggestionCreatedListener::class,
        ],
        Subject\AcceptWithMail::class => [
            SendMail\SubjectAcceptWithMailListener::class,
        ],
        Subject\Updated::class => [
            SendMail\SubjectUpdatedListener::class,
        ],
        Assistant\Created::class => [
            SendMail\AssistantCreatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
