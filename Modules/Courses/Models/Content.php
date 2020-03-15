<?php

namespace Courses\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'type', 'url', 'title', 'description', 'date'
    ];

    /**
     * Get the course for the category.
     *
     * @return Illuminate\Database\Eloqunet\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Courses\Models\Category');
    }

    /**
     * Get the content media.
     *
     * @return Illuminate\Database\Eloqunet\Relations\HasMany
     */
    public function media()
    {
        return $this->hasMany('Courses\Models\Media');
    }
}