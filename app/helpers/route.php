<?php

if (!function_exists('buildRoutePrefix')) {

    /**
     * build the module route prefix
     *
     * @param  string $target
     * @return string
     */
    function buildRoutePrefix(string $target)
    {
        return config('module.routes.prefix.' . $target);
    }
}