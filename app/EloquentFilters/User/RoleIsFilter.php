<?php
namespace App\EloquentFilters\Incident;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class EngineerIsFilter extends Filter
{
    /**
     * Apply role name condition to the query.
     *
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->role($value)->get();
    }
}
