<?php

namespace Domain\Product\Actions\Category;

use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateCategoryProductAction extends Action
{
    public function execute($data)
    {
        $find = CategoryProduct::where('code', $data['code'])->first();
        if ($find) {
            throw new BadRequestException('code sudah di pake');
        }
        $category = CategoryProduct::create($data);

        return $category;
    }
}
