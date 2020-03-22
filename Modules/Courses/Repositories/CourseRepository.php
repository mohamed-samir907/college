<?php

namespace Courses\Repositories;

use Courses\Models\Course;
use Courses\Models\Category;
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

    /**
     * Get the user courses.
     *
     * @return Collection
     */
    public function getUserCourses()
    {
        $user = apiUser();

        return Course::with('categories')->where('group', '=', $user->group)
                ->where('level', '=', $user->level)
                ->get();
    }

    /**
     * Get the category contents for the authenticated user.
     *
     * @param  int $category
     * @return Collection
     */
    public function getUserContents($category)
    {
        return $category->contents;
    }

    /**
     * Get the category.
     *
     * @param  int $id
     * @return Category|null
     */
    public function findCategory($id)
    {
        return Category::with(['course', 'contents'])->find($id);
    }
}
