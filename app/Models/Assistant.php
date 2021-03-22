<?php

namespace App\Models;

use App\Events\Assistant\Created;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'know_what_to_do',
        'what_to_do',
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
    ];
}
