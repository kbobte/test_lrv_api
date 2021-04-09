<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Registration extends Model
{

    public function scopeApplyFilters()
    {
        $sortBy = request('sort_by');
        $sortDesc = request('sort_desc');
        $direction = $sortDesc === 'true' ? 'desc' : 'asc';
        if (!$sortBy) {
            $query = $this->query();
        } else {
            $query = $this->query()->orderBy($sortBy, $direction);
        }

        return app(Pipeline::class)
                ->send($query)
                ->through([
                    QueryFilters\Email::class,
                    QueryFilters\Egn::class,
                    QueryFilters\Status::class,
                ])->thenReturn()->paginate(30);
//                ])->thenReturn()->limit(10);
//                ])->thenReturn()->limit(10)->get('age');
    }

}
