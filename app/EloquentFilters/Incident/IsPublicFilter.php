<?php

namespace App\EloquentFilters\Incident;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\IFilter as Filter;
use Illuminate\Database\Eloquent\Builder;

class IsPublicFilter implements Filter
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
        $value = $value === 'true' ? true : false;
        return $builder->where('is_public', $value);
    }
}