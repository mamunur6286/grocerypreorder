<?php

namespace GroceryStore\PreOrderManagement\Filters;

use App\Interfaces\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PreOrderFilter implements FilterInterface
{
    public function filter(Builder $builder, Request $request): Builder
    {
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');

        $builder->when($fromDate && $toDate, function ($builder) use ($fromDate, $toDate) {
            $builder->whereBetween( 'created_at', $fromDate, $toDate);
        });

        return $builder;
    }
}
