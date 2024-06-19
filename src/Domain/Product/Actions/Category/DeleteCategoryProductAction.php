<?php

namespace Domain\Product\Actions\Category;

use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Shared\Foundations\Action;

class DeleteCategoryProductAction extends Action
{
    public function execute(CategoryProduct $category)
    {
        $category->delete();

        return true;
    }
}
