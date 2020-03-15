<?php

namespace Courses\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'course_id'
    ];

    /**
     * Get the course for the category.
     *
     * @return Illuminate\Database\Eloqunet\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('Courses\Models\Course');
    }

    /**
     * Get the contents related to the category.
     *
     * @return Illuminate\Database\Eloqunet\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany('Courses\Models\Content');
    }
}