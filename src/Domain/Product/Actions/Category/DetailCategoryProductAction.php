<?php

namespace Domain\Product\Actions\Category;

use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Shared\Foundations\Action;

class DetailCategoryProductAction extends Action
{
    protected $cat;

    public function execute(CategoryProduct $category, $query)
    {
        $this->cat = $category;

        return $this->cat;
    }
}
