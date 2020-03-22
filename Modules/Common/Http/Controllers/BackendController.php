<?php

namespace Common\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Common\Repositories\MainRepository;

class BackendController extends Controller
{
    protected $repository;

    public function __construct(MainRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->repository->getRecords(20);

        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => $records
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return response()->json([
            'status' => 200,
            'msg' => 'Record created successfully',
            'data' => ''
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->repository->find($id);

        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => $record
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($id, $request->all());

        return response()->json([
            'status' => 200,
            'msg' => 'Record updated successfully',
            'data' => ''
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([
            'status' => 200,
            'msg' => 'Record deleted successfully',
            'data' => ''
        ], 200);
    }
}
