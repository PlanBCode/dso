<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingRound extends Model
{
    use HasFactory;

    const PROGRESS_STATE_NOT_STARTED = 'not started';
    const PROGRESS_STATE_IN_PROGRESS = 'in progress';
    const PROGRESS_STATE_COMPLETED = 'completed';
    const PROGRESS_STATE_UNKNOWN = 'unknown';

    const PROGRESS_STATES = [
        self::PROGRESS_STATE_NOT_STARTED,
        self::PROGRESS_STATE_IN_PROGRESS,
        self::PROGRESS_STATE_COMPLETED,
        self::PROGRESS_STATE_UNKNOWN,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'begin',
        'end',
        'in_progress',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'begin' => 'date:Y-m-d',
        'end' => 'date:Y-m-d',
        'in_progress' => 'boolean',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function winning_subjects()
    {
        return $this->belongsToMany(Subject::class, 'winning_subject_voting_round');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class)->isEnabled();
    }

    public function scopeNotStarted(Builder $query): Builder
    {
        $tomorrow = Carbon::tomorrow();
        return $query->where([
            ['begin', '>', $tomorrow],
            ['end', '>', $tomorrow],
        ]);
    }
    public function scopeInProgress(Builder $query): Builder
    {
        $today = Carbon::today();
        return $query->where([
            ['begin', '<=', $today],
            ['end', '>=', $today],
        ]);
    }
    public function scopeCompleted(Builder $query): Builder
    {
        $yesterday = Carbon::yesterday();
        $yesterday->setTime(23, 59, 59);
        return $query->where([
            ['begin', '<', $yesterday],
            ['end', '<', $yesterday],
        ]);
    }

    public function getProgressState(): string
    {
        /** @var Carbon $begin */
        $begin = $this->begin;
        $begin->setTime(0, 0);

        /** @var Carbon $end */
        $end = $this->end;
        $end->setTime(23, 59,59);

        if ($begin->isFuture() && $end->isFuture()) {
            return self::PROGRESS_STATE_NOT_STARTED;
        }
        if ($begin->isPast() && $end->isFuture()) {
            return self::PROGRESS_STATE_IN_PROGRESS;
        }
        if ($begin->isPast() && $end->isPast()) {
            return self::PROGRESS_STATE_COMPLETED;
        }
        return self::PROGRESS_STATE_UNKNOWN;
    }

    public function getVotes(): array
    {
        $votes = array_fill_keys($this->subjects->pluck('id')->all(), 0);
        foreach ($this->votes as $vote) {
            if (empty($votes[$vote->subject_id])) {
                $votes[$vote->subject_id] = 0;
            }
            $votes[$vote->subject_id]++;
        }

        return $votes;
    }

    public function getSubjectsSortedByVoteCount(): array
    {
        $votes = $this->getVotes();
        arsort($votes);

        $sorted = [];
        $subjects = $this->subjects->keyBy('id');
        foreach ($votes as $subjectId => $votes) {
            $sorted[] = $subjects[$subjectId];
        }

        return $sorted;
    }
}
