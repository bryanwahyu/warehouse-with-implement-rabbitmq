<?php

namespace Domain\Product\Actions\Category;

use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateCategoryProductAction extends Action
{
    public function execute(CategoryProduct $category, $data)
    {
        $category->fill($data);
        if ($category->isDirty('code')) {
            $find = CategoryProduct::where('code', $data['code'])->first();
            if ($find) {
                throw new BadRequestException('Code sudah digunakan');
            }
        }
        $category->save();

        return $category;
    }
}
