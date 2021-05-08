<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voting_round_id',
        'subject_id',
        'email',
        'why_important',
        'extra',
        'disabled',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'agree_to_terms' => 'boolean',
        'extra' => 'array',
        'disabled' => 'boolean',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    /**
     * The VotingRound that this Vote belongs to
     */
    public function votingRound()
    {
        return $this->belongsTo(VotingRound::class);
    }

    /**
     * The Subject of this Vote
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function scopeIsEnabled(Builder $query): Builder
    {
        return $query->where([
            ['disabled', '=', false],
        ]);
    }
}
