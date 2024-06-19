<?php

namespace Domain\Bahan\Actions\Category;

use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Foundations\Action;

class DetailCategoryAction extends Action
{
    protected $cat;

    public function execute(Category $category, $query)
    {
        $this->cat = $category;

        return $this->cat;
    }
}
