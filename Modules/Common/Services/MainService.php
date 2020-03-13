<?php

namespace Common\Services;

use Common\Interfaces\ServiceInterface;
use Common\Interfaces\RepositoryInterface;

class MainService implements ServiceInterface
{
    /** @var RepositoryInterface */
    private $repository;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $repository
     * @return void
     */
    public function _construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /** @inheritDoc */
    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    /** @inheritDoc */
    public function get(int $count = null)
    {
        if ($count !== null) {
            return $this->repository->getPaginated($count);
        }

        return $this->repository->get();
    }

    /** @inheritDoc */
    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    /** @inheritDoc */
    public function update(array $data, Model $model)
    {
        return $this->repository->update($data, $model);
    }

    /** @inheritDoc */
    public function delete(Model $model)
    {
        return $this->repository->delete($model);
    }
}