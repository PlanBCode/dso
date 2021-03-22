<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
    ];

    /**
     * Get the parent fileable model.
     */
    public function fileable()
    {
        return $this->morphTo();
    }

    public function getFullPath(): string
    {
        return storage_path('app/public/' . $this->file_path);
    }

    public function isImage(): bool
    {
        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
        $contentType = mime_content_type($this->getFullPath());

        return in_array($contentType, $allowedMimeTypes);
    }

    public function getExtension()
    {
        return pathinfo($this->getFullPath(), PATHINFO_EXTENSION);
    }
}
