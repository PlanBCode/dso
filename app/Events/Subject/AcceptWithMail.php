<?php

namespace App\Events\Subject;

use App\Models\Subject ;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptWithMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Subject */
    private $subject;

    /** @var bool */
    private $accept;

    /** @var string */
    private $mailSubject;

    /** @var string */
    private $mailContent;

    public function __construct(Subject $subject, bool $accept, string $mailSubject, string $mailContent)
    {
        $this->subject = $subject;
        $this->mailSubject = $mailSubject;
        $this->mailContent = $mailContent;
        $this->accept = $accept;
    }

    public function getSubject(): Subject
    {
        return $this->subject;
    }

    public function isAccept(): bool
    {
        return $this->accept;
    }

    public function getMailSubject(): string
    {
        return $this->mailSubject;
    }

    public function getMailContent(): string
    {
        return $this->mailContent;
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
