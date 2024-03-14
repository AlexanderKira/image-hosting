<?php

namespace App\Services\Filters\images\Filters;

use App\Services\Filters\Filter;
use Carbon\Carbon;

class EndDateFilter extends Filter
{
    public function apply($query, $value)
    {
        if ($value) {
            $value = Carbon::parse($value);
            return $query->where('updated_at', '<=', $value);
        }

        return $this->next ? $this->next->apply($query, $value) : $query;
    }
}
