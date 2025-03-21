<?php

namespace App\Interfaces;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
interface FilterInterface
{
    public function filter(Builder $builder, Request $request);
}
