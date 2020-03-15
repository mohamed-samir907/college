<?php

namespace Courses\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Courses\Services\CourseService;
use App\Http\Controllers\Controller;
use Courses\Http\Resources\CourseResource;
use Courses\Repositories\CourseRepository;
use Courses\Http\Resources\ContentResource;

class EndpointsController extends Controller
{
    private $service;

    /**
     * Constructor.
     *
     * @param CourseService $service
     */
    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    /**
     * Get the courses for the current authenticated user.
     *
     * @return JsonResponse
     */
    public function courses()
    {
        $courses = $this->service->getUserCourses();

        return response()->json([
            'code' => 0,
            'data' => CourseResource::collection($courses)
        ], 200);
    }

    /**
     * Get the category contents for the authenticated user.
     *
     * @param  int $categoryId
     * @return JsonResponse
     */
    public function contents($categoryId)
    {
        $category = $this->service->validateCategory($categoryId);

        if ($category instanceof JsonResponse) {
            return $category;
        }

        $contents = $this->service->getUserContents($category);

        return response()->json([
            'code' => 0,
            'data' => ContentResource::collection($contents)
        ], 200);
    }
}