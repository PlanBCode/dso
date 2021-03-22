<?php

namespace App\Models;

use App\Events\SubjectSuggestion\Created;
use App\Events\SubjectSuggestion\Updated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'importance',
        'skills',
        'firstname',
        'lastname',
        'phone',
        'email',
        'agree_to_terms',
        'email_confirmation_code',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => Created::class,
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
     * The subject that this suggestion belongs to
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
