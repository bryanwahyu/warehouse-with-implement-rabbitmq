<?php

namespace Domain\Bahan\Filter;

use Infra\Shared\Foundations\Filter;

class BahanFilter extends Filter
{
    protected function category($value)
    {
        $value = explode(',', $value);
        $this->builder->whereIn('category_id', $value);
    }

    protected function count($value)
    {
        $value = explode(',', $value);
        $this->builder->withCount($value);
    }

    protected function with($value)
    {
        $value = explode(',', $value);
        $this->builder->with($value);
    }

    protected function page($value)
    {
        $pageSize = $this->request->get('page_size', 15);
        $this->builder->paginate($pageSize, ['*'], 'page', $value);
    }
}
