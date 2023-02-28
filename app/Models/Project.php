<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'publication_date', 'preview', 'complexity', 'language_used', 'github_url'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function isAnUrl()
    {
        return filter_var($this->preview, FILTER_VALIDATE_URL);
    }
}
