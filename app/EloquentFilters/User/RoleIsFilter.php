<?php
namespace App\EloquentFilters\User;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class RoleIsFilter extends Filter
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
        try {
            // Validate the value...
            $query = $builder->role($value);
            return $query;
        } catch (RoleDoesNotExist $e) {
            report($e);
            abort(404, 'Oops! We could not find the role you requested for.');
        }
    }
}
