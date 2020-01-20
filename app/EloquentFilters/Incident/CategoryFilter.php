<?php

namespace App\EloquentFilters\Incident;

use App\Category;
use App\Type;
use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\IFilter as Filter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements Filter
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
