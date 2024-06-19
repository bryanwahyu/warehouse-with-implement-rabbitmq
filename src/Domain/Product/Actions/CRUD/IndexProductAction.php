<?php

namespace Domain\Product\Actions\CRUD;

use Domain\Product\Filter\ProductFilter;
use Illuminate\Http\Request;
use Infra\Produksi\Models\Product;
use Infra\Shared\Foundations\Action;

class IndexProductAction extends Action
{
    protected $product;

    public function execute(Request $request)
    {
        $filter = new ProductFilter($request);

        return $filter->apply(Product::query())->get();
    }
}
