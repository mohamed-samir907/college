<?php

namespace Courses\Http\Controllers\Backend;

use Courses\Repositories\ContentRepository;
use Common\Http\Controllers\BackendController;

class ContentsController extends BackendController
{
    /**
     * Constructor.
     *
     * @param CourseRepository $repository
     */
    public function __construct(ContentRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create()
    {
        $categories = $this->repository->getCategories();

        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => $categories
        ]);
    }
}
