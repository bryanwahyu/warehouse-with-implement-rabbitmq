<?php

namespace Domain\Product\Actions\Recipe;

use Illuminate\Support\Arr;
use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Shared\Foundations\Action;

class GetRecipeAction extends Action
{
    protected $res;

    public function execute($query)
    {
        $this->res = Recipe::query();
        if (Arr::exists($query, 'product_id')) {
            $this->handleProduct($query['product_id']);
        }
        if (Arr::exists($query, 'with')) {
            $this->handleWith($query['with']);
        }

        return $this->res->get();
    }

    protected function handleProduct($product)
    {
        $pr = explode(',', $product);
        $this->res = $this->res->whereIn('product_id', $pr);
    }

    protected function handleWith($relationship)
    {
        $with = explode(',', $relationship);
        $this->res = $this->res->with($with);
    }
}
