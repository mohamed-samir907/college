<?php

namespace Courses\Repositories;

use Courses\Models\Course;
use Courses\Models\Category;
use Common\Repositories\MainRepository;

class CategoryRepository extends MainRepository
{
    public function builder()
    {
        return Category::query();
    }

    public function getDisplayableColumns()
    {
        return ['id', 'course_id', 'name'];
    }

    public function getUpdatableColumns()
    {
        return ['course_id', 'name'];
    }

    /**
     * Get records.
     *
     * @return Collection
     */
    public function getRecords($limit)
    {
        return $this->builder->with('course')->paginate($limit);
    }

    public function getCourses()
    {
        return Course::all();
    }
}
