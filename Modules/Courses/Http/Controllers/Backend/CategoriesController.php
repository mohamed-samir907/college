<?php

namespace Courses\Http\Controllers\Backend;

use Courses\Repositories\CategoryRepository;
use Common\Http\Controllers\BackendController;

class CategoriesController extends BackendController
{
    /**
     * Constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create()
    {
        $courses = $this->repository->getCourses();

        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => $courses
        ]);
    }
}
