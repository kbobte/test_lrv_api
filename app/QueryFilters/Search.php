<?php

namespace App\QueryFilters;

class Search extends Filter
{
    protected function applyFilter($builder)
    {
        switch (\Request::route()->getName()) {
            default:
                return $this->genericSearchTerm($builder, '%' . request()->input('search') . '%', 'ILIKE');
                break;
        }
    }

}
