<?php

namespace Courses\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_id', 'type', 'url'
    ];

    /**
     * Get the content for the category.
     *
     * @return Illuminate\Database\Eloqunet\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo('Courses\Models\Content');
    }
}