<?php

namespace App\Models;

use App\Events\Subject\Created;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'state',
    ];

    /**
     * Get all of the files.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * The suggestion that belong to this subject
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
