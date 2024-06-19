<?php

namespace Domain\Product\Actions\CRUD;

use Illuminate\Support\Arr;
use Infra\Produksi\Models\Product;
use Infra\Shared\Foundations\Action;

class DetailProductAction extends Action
{
    protected $prod;

    public function execute(Product $prod, $query)
    {
        $this->prod = $prod;
        if (Arr::exists($query, 'with')) {
            $this->handleLoad($query['with']);
        }

        return $this->prod;
    }

    protected function handleLoad($relationship)
    {
        $with = explode(',', $relationship);
        $this->prod = $this->prod->load($with);
    }
}
