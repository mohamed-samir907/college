<?php

namespace Courses\Repositories;

use Courses\Models\Content;
use Courses\Models\Category;
use Common\Repositories\MainRepository;

class ContentRepository extends MainRepository
{
    public function builder()
    {
        return Content::query();
    }

    public function getDisplayableColumns()
    {
        return ['id', 'category_id', 'type', 'title'];
    }

    public function getUpdatableColumns()
    {
        return ['category_id', 'type', 'title'];
    }

    /**
     * Get records.
     *
     * @return Collection
     */
    public function getRecords($limit)
    {
        return $this->builder->with('category')
                ->with('category.course')->paginate($limit);
    }

    public function getCategories()
    {
        return Category::with('course')->get();
    }
}
