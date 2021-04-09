<?php

namespace App\QueryFilters;

class Status extends Filter
{

    protected function applyFilter($builder)
    {
        $value = request($this->filterName());
        return $builder->where($this->filterName(), $value);
    }

}
