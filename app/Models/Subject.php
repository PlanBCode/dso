<?php

namespace App\Models;

use App\Events\Subject\Updated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    const STATE_DRAFT = 'draft';
    const STATE_NEW = 'new';
    const STATE_REJECTED = 'rejected';
    const STATE_IN_VOTING_ROUND = 'in voting round';

    const STATES = [
        self::STATE_DRAFT,
        self::STATE_NEW,
        self::STATE_REJECTED,
        self::STATE_IN_VOTING_ROUND,
    ];

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'state',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => Updated::class,
    ];

    /**
     * Get all of the files.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * The Suggestion that belong to this Subject
     */
    public function suggestion()
    {
        return $this->hasOne(SubjectSuggestion::class);
    }

    public function getImagePath(): string
    {
        return storage_path('app/public/' . $this->image);
    }
}
