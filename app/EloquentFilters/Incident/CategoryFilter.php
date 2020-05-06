<?php

namespace App\EloquentFilters\Incident;

use App\Category;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Filter
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
        $category = Category::whereId($value)->first();
        $type = $category ? $category->types()->first() : null;
        if(!$type){
            return $builder;
        }

        return $builder->where('type_id', $type->id);
    }
}
