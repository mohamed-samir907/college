<?php

namespace Common\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * Find record.
     *
     * @param  int $id
     * @return Model|null
     */
    public function find(int $id);

    /**
     * Get a collection of records.
     *
     * @param  int $count
     * @return Collection
     */
    public function get(int $count = null);

    /**
     * Store the givend data to database.
     *
     * @param  array $data
     * @return Model
     */
    public function store(array $data);

    /**
     * Updae the given record.
     *
     * @param  array $data
     * @param  Model $model
     * @return bool
     */
    public function update(array $data, Model $model);

    /**
     * Delete an existing record.
     *
     * @param  Model $model
     * @return bool
     */
    public function delete(Model $model);
}