<?php

namespace App\QueryFilters;

class Sort extends Filter
{

    protected function applyFilter($builder)
    {
        $sortBy = request('sort_by');
        $sortDesc = request('sort_desc');
        return $builder->orderBy('age');
//        return $builder->orderBy($sortBy, $sortDesc ? self::DESC : self::ASC);
    }

}
