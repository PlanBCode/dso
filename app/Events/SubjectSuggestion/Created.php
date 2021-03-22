<?php

namespace App\Events\SubjectSuggestion;

use App\Models\SubjectSuggestion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Created
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var SubjectSuggestion */
    private $subjectSuggestion;

    public function __construct(SubjectSuggestion $subjectSuggestion)
    {
        $this->subjectSuggestion = $subjectSuggestion;
    }

    public function getSubjectSuggestion(): SubjectSuggestion
    {
        return $this->subjectSuggestion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
