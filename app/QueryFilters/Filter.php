<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{

    const ASC = 'asc';
    const DESC = 'desc';
    const NEGATIVE = 0;
    const POSITIVE = 1;

    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName())) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    protected function filterName()
    {
        // Use class name as filter name
        return Str::snake(class_basename($this));
    }

    abstract protected function applyFilter($builder);

    protected function genericSearchTerm($builder, $searchTerm, $operator)
    {
        $model = $builder->getModel();
        if (is_null($model)) {
            return $builder;
        }

        $searchableFields = $model->translatedAttributes;

        if (is_null($searchableFields)) {
            return $builder;
        }

        $translationTable = $this->getTable($model);

        if (is_null($translationTable)) {
            return $builder;
        }

        return $builder->where(function ($query) use ($searchableFields, $searchTerm, $translationTable, $operator) {
            foreach ($searchableFields as $field) {
                $query->orWhereHas('translations', function ($query) use ($field, $searchTerm, $translationTable, $operator) {
                    $query->where($translationTable . '.' . $field, $operator, $searchTerm);
                });
            }
        });
    }

    private function getTable($model)
    {
        $translationModel = $model->getTranslationModelName();
        if (is_null($translationModel)) {
            return null;
        }

        $translationTable = app()->make($translationModel)->getTable();
        if (is_null($translationTable)) {
            return null;
        }

        return $translationTable;
    }
}
