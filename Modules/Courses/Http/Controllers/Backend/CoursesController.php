<?php

namespace Courses\Http\Controllers\Backend;

use Courses\Repositories\CourseRepository;
use Common\Http\Controllers\MainController;

class CoursesController extends MainController
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