<?php

namespace Common\Http\Controllers;

use Illuminate\Http\Request;
use Common\Repositories\MainRepository;
use App\Http\Controllers\Controller;

abstract class MainController extends Controller
{
    /** @var MainRepository */
    private $repository;

    /**
     * Constructor.
     *
     * @param MainRepository $repository
     */
    public function __construct(MainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json([
            'data' => [
                'table'         => $this->repository->getTable(),
                'displayable'   => array_values($this->repository->getDisplayableColumns()),
                'records'       => $this->repository->getRecords()
            ]
        ], 200);
    }
}