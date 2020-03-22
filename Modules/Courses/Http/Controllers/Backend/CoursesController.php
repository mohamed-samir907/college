<?php

namespace Courses\Http\Controllers\Backend;

use Courses\Repositories\CourseRepository;
use Common\Http\Controllers\BackendController;

class CoursesController extends BackendController
{
    /**
     * Constructor.
     *
     * @param CourseRepository $repository
     */
    public function __construct(CourseRepository $repository)
    {
        parent::__construct($repository);
    }
}
