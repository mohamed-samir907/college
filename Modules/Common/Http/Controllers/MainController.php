<?php

namespace Common\Http\Controllers;

use Illuminate\Http\Request;
use Common\Repositories\MainRepository;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /** @var MainRepository */
    protected $repository;

    /**
     * Constructor.
     *
     * @param MainRepository $repository
     */
    public function __construct(MainRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return response()->json([
            'data' => [
                'table'         => $this->repository->getTable(),
                'displayable'   => array_values($this->repository->getDisplayableColumns()),
                'updatable'     => array_values($this->repository->getUpdatableColumns()),
                'records'       => $this->repository->getRecords($request->limit)
            ]
        ], 200);
    }
}