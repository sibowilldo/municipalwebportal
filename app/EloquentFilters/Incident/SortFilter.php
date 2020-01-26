<?php

namespace App\EloquentFilters\Incident;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\IFilter as Filter;
use Illuminate\Database\Eloquent\Builder;

class SortFilter implements Filter
{
    /**
     * Apply is public condition to the query.
     *
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        $sorts = explode(',', $value);
        $incidents = $builder;
        foreach ($sorts as $sort) {
            list($sortCol, $sortDir) = explode('|', $sort);
            $incidents = $builder->orderBy($sortCol, $sortDir);
        }
        return $incidents;
    }
}
