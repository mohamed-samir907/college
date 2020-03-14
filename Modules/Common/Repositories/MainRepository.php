<?php

namespace Common\Repositories;

use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Common\Interfaces\RepositoryInterface;

class MainRepository implements RepositoryInterface
{
    /** @var Illuminate\Database\Eloquent\Builder */
    protected $builder;

    /**
     * Builder Class.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function builder()
    {
        // 
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $builder  = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception("Entity not instance of Builder");
        }

        $this->builder = $builder;
    }

    /**
     * Get records.
     *
     * @return Collection
     */
    public function getRecords($limit)
    {
        return $this->builder->limit($limit)->get($this->getDisplayableColumns());
    }

    /**
     * Get the displayable columns.
     *
     * @return array
     */
    public function getDisplayableColumns()
    {
        return array_diff($this->getDatabaseColumnNames(), $this->builder->getModel()->getHidden());
    }

    /**
     * Get the updatable columns.
     *
     * @return array
     */
    public function getUpdatableColumns()
    {
        return $this->getDisplayableColumns();
    }

    /**
     * Get table all columns.
     *
     * @return array
     */
    public function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->getTable());
    }

    /**
     * Get the model table name.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->builder->getModel()->getTable();
    }
}