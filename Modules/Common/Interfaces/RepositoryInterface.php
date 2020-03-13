<?php

namespace Common\Interfaces;

interface RepositoryInterface
{
    /**
     * Builder Class.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function builder();
}