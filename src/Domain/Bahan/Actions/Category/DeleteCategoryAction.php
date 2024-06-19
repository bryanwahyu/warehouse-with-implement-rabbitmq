<?php

namespace Domain\Bahan\Actions\Category;

use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Foundations\Action;

class DeleteCategoryAction extends Action
{
    public function execute(Category $category)
    {
        $category->delete();

        return true;
    }
}
