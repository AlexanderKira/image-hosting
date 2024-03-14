<?php

namespace App\Services\Filters;

abstract class Filter
{
    protected $next;

    abstract public function apply($query, $value);
}
