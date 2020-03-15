<?php

namespace Courses\Services;

use Illuminate\Support\Facades\Validator;
use Courses\Repositories\CourseRepository;

class CourseService
{
    /**
     * The repository that will be used.
     *
     * @var CourseRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param CourseRepository $repository
     */
    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function repository()
    {
        return $this->repository;
    }

    /**
     * Get the user courses.
     *
     * @return Collection
     */
    public function getUserCourses()
    {
        return $this->repository->getUserCourses();
    }

    /**
     * Get the category contents for the authenticated user.
     *
     * @param  Category $category
     * @return Collection
     */
    public function getUserContents($category)
    {
        return $this->repository->getUserContents($category);
    }

    /**
     * Validate the category.
     *
     * @param  int $id
     * @return JsonResponse|Category
     */
    public function validateCategory($id)
    {
        $category = $this->repository->findCategory($id);

        if (!$category) {
            return response()->json([
                'code' => 2,
                'data' => [
                    "error" => "category not found"
                ]
            ], 404);
        }

        $user   = apiUser();
        $course = $category->course;

        if ($user->group != $course->group && $user->level != $course->level) {
            return response()->json([
                'code' => 2,
                'data' => [
                    "error" => "current user can not access the course content"
                ]
            ], 400);
        }

        return $category;
    }
}