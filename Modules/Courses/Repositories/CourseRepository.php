<?php

namespace Courses\Repositories;

use Courses\Models\Course;
use Common\Repositories\MainRepository;

class CourseRepository extends MainRepository
{
    public function builder()
    {
        return Course::query();
    }

    public function getDisplayableColumns()
    {
        return ['id', 'name', 'level', 'group'];
    }

    public function getUpdatableColumns()
    {
        return ['name', 'level', 'group'];
    }
}