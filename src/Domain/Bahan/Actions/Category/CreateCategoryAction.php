<?php

namespace Domain\Bahan\Actions\Category;

use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateCategoryAction extends Action
{
    public function execute($data)
    {
        $find = Category::where('code', $data['code'])->first();
        if ($find) {
            throw new BadRequestException('code sudah di pake');
        }
        $category = Category::create($data);

        return $category;
    }
}
