<?php

namespace Domain\Bahan\Actions\Category;

use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateCategoryAction extends Action
{
    public function execute(Category $category, $data)
    {
        $category->fill($data);
        if ($category->isDirty('code')) {
            $find = Category::where('code', $data['code'])->first();
            if ($find) {
                throw new BadRequestException('Code sudah digunakan');
            }
        }
        $category->save();

        return $category;
    }
}
