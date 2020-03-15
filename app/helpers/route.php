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

if (!function_exists('apiUser')) {

    /**
     * Get the current authenticated user with guard api.
     *
     * @return \App\User|null
     */
    function apiUser()
    {
        return auth('api')->user();
    }
}