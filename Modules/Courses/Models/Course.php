<?php

namespace Courses\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'level', 'group'
    ];

    /**
     * Get the categories related to the course.
     *
     * @return Illuminate\Database\Eloqunet\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany('Courses\Models\Category');
    }
}