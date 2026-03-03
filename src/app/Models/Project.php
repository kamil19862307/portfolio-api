<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'image',
        'position',
        'is_locked',
        'status',
        'development_days',
        'github_url',
        'demo_url',
    ];

    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image);
    }

    protected $appends = ['image_url'];

    public function isLocked()
    {
        return $this->is_locked;
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}
