<?php

namespace App\EloquentFilters\Incident;

use App\Category;
use App\Type;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\IFilter as Filter;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements Filter
{
    /**
     * Apply category condition to the query.
     *
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->where('name', 'like' , "%$value%");
    }
}
